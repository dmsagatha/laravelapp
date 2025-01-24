<?php

namespace App\Http\Controllers;

use App\Models\{Processor, Prototype, Memory};
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
    $memories = Memory::all();
    
    return view('processors.create', compact('memories'));
  }
  
  public function store(Request $request)
  {
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
    $file = $request->file('import_file')->store('importProcessors');
    $import = new ProcessorsImport;
    $import->import($file);
    // dd($import->errors());
    // dd($import->failures());

    // Mostrar los errores que los registros no se crearán en la base de datos
    if ($import->failures()->isNotEmpty()) {
      return back()->withFailures($import->failures());
    }

    return redirect()->route('processors.index')->with('success', 'Datos importados exitosamente!');
  }

  /**
    * Show the form for editing the specified resource.
    */
  public function edit(Processor $processor)
  {
  }

  /**
    * Update the specified resource in storage.
    */
  public function update(Request $request, Processor $processor)
  {
  }

  /**
    * Remove the specified resource from storage.
    */
  public function destroy(Processor $processor)
  {
  }
}