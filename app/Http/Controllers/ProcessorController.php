<?php

namespace App\Http\Controllers;

use App\Imports\ProcessorsImport;
use App\Models\Processor;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProcessorController extends Controller
{
  public function index()
  {
    $processors = Processor::orderBy('mac')->get();
    
    return view('admin.processors.index', compact('processors'));
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

    // Mostrar los errores que no crearán en la base de datos
    if ($import->failures()->isNotEmpty()) {
      return back()->withFailures($import->failures());
    }

    return redirect()->route('processors.index')->with('success', 'Datos importados exitosamente!');
  }
  
  public function create()
  {
  }
  
  public function store(Request $request)
  {
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