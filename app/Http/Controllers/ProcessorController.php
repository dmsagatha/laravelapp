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
    $processors = Processor::with('memories')->orderBy('mac')->get();

    return view('admin.processors.index', compact('processors'));
  }

  public function create()
  {
    $processor  = new Processor();
    $users      = User::orderBy('name')->get();
    $prototypes = Prototype::orderBy('reference')->get();
    $memories   = Memory::orderBy('serial')->get();

    return view('admin.processors.createUpdate', compact('processor', 'users', 'prototypes', 'memories'));
  }

  public function store(ProcessorRequest $request)
  {
    // dd($request->all());
    // $processor = Processor::create($request->only('mac', 'servicetag', 'user_id', 'prototype_id'));

    /* foreach ($request->input('memories') as $memory) {
      $processor->memories()->attach($memory['id'], ['quantity' => $memory['quantity']]);
    } */
    /* $memories = collect($request->input('memories'))->mapWithKeys(function ($memory) {
        return [$memory['id'] => ['quantity' => $memory['quantity']]];
    }); */

    // $processor->memories()->sync($memories);

    $processor = Processor::create($request->validated());

    if ($request->filled('memories')) {
      $memories = [];
      foreach ($request->memories as $memory) {
        $memories[$memory['id']] = ['quantity' => $memory['quantity']];
      }

      $processor->memories()->attach($memories);
    }

    return redirect()->route('processors.index')->with('success', 'Registro creado satisfactoriamente!');
  }

  public function edit(Processor $processor)
  {
    $users      = User::orderBy('name')->get();
    $prototypes = Prototype::orderBy('reference')->get();
    $memories   = Memory::orderBy('serial')->get();

    return view('admin.processors.createUpdate', compact('processor', 'users', 'prototypes', 'memories'));
  }

  public function update(ProcessorRequest $request, Processor $processor)
  {
    /* $processor->update($request->only('mac', 'servicetag', 'user_id', 'prototype_id'));

    $syncData = [];
    foreach ($request->input('memories') as $memory) {
      $syncData[$memory['id']] = ['quantity' => $memory['quantity']];
    }

    $processor->memories()->sync($syncData); */


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