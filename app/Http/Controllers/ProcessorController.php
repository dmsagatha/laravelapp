<?php

namespace App\Http\Controllers;

use App\Models\{Processor, Prototype, Memory, User};
use App\Http\Requests\ProcessorRequest;
use App\Imports\ProcessorsImport;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProcessorController extends Controller
{
  public function index()
  {
    $processors = Processor::with('user', 'prototype', 'memories', 'addMemories')->orderBy('mac')->get();

    return view('admin.processors.index', compact('processors'));
  }

  public function create()
  {
    return view('admin.processors.createUpdate', [
        'processor'        => new Processor(),
        'users'            => User::fullUsers(),
        'prototypes'       => Prototype::fullPrototypes(),
        'memories'         => Memory::orderBy('serial')->get(),
        'selectedMemories' => [], // Vacío en creación
    ]);
  }

  public function store(ProcessorRequest $request)
  {
    try {
      $processor = Processor::create($request->validated());

      if ($request->filled('memories')) {
        $memories = [];
        foreach ($request->memories as $memory) {
          $memories[$memory['id']] = ['quantity' => $memory['quantity']];
        }
        $processor->memories()->attach($memories);
      }

      return redirect()->route('processors.index')->with('success', 'Registro creado satisfactoriamente!');
    } catch (\Exception $e) {
      return back()->withErrors(['error' => 'No se pudo guardar el procesador: ' . $e->getMessage()])->withInput();
    }
  }

  public function edit(Processor $processor)
  {
    $selectedMemories = $processor->memories->map(function ($memory) {
      return [
          'id'       => $memory->id,
          'quantity' => $memory->pivot->quantity,
      ];
    });

    return view('admin.processors.createUpdate', [
        'processor'        => $processor,
        'users'            => User::fullUsers(),
        'prototypes'       => Prototype::fullPrototypes(),
        'memories'         => Memory::orderBy('serial')->get(),
        'selectedMemories' => $selectedMemories
    ]);
  }

  public function update(ProcessorRequest $request, Processor $processor)
  {
    $processor->update($request->validated());

    if ($request->filled('memories')) {
      $memories = [];
      foreach ($request->memories as $memory) {
        $memories[$memory['id']] = ['quantity' => $memory['quantity']];
      }
      $processor->memories()->sync($memories);
    } else {
      $processor->memories()->detach();
    }

    return redirect()->route('processors.index')->with('success', 'Registro actualizado correctamente.');
  }

  public function destroy(Processor $processor)
  {
    $processor->delete();

    return redirect()->route('processors.index')->with('success', 'Registro eliminado satisfactoriamente!');
  }

  public function getReferences(Request $request)
  {
    $modelType = $request->input('model_type');

    if (!$modelType) {
      return response()->json([], 400);
    }

    // Crear una clave única para el caché basada en el tipo de modelo
    $cacheKey = "references_{$modelType}";

    // Recuperar datos de caché o consulta y almacena
    $references = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($modelType) {
      return Prototype::where('model_type', $modelType)->pluck('reference', 'id'); // Devuelve id y referencia
    });

    return response()->json($references);
  }

  public function updateReference(Request $request, Prototype $prototype)
  {
    $prototype->update($request->all());

    // Borra el caché para este modelo
    Cache::forget("references_{$prototype->model_type}");

    return redirect()->back()->with('success', 'Referencias actualizadas satisfactoriamente!');
  }

  /**
   * #2: Laravel Excel Import to Database with Errors and Validation Handling
   * https://www.youtube.com/watch?v=Q2AUH9w9XaA
   */
  public function import(Request $request)
  {
    // use Importable;   ProcessorsImport
    $file   = $request->file('import_file')->store('importProcessors');
    $import = new ProcessorsImport();
    $import->import($file);
    // dd($import->errors());
    // dd($import->failures());

    // Mostrar los errores que los registros no se crearán en la base de datos
    if ($import->failures()->isNotEmpty()) {
      return back()->withFailures($import->failures());
    }

    return redirect()->route('processors.index')->with('success', 'Datos importados exitosamente!');
  }
}