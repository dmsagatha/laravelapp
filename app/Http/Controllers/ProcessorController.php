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
  
  public function import(Request $request)
  {
    try {
      if (!$request->hasFile('import_file')) {
       throw new \Exception('El archivo no existe.');
      }

      $file = $request->import_file;
      Excel::import(new ProcessorsImport, $file);
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
      $failures = $e->failures();
      $errors = [];
      
      foreach ($failures as $failure) {
        $failure->row(); // fila que falló
        $failure->attribute(); // clave de encabezado (si se usa la fila de encabezado) o índice de columna
        $failure->errors(); // Mensajes de error reales del validador de Laravel
        $failure->values(); // Los valores de la fila que falló

        // $errors[$failure->row()][$failure->column()] = $failure->errors();
      }

      return back()->with('errors', $errors);
    };

    Session()->flash('statusCode', 'success');
    
    return redirect()->route('processors.index')->with('success', 'Datos importados exitosamente!');

    /* $file = $request->file('import_file');    
    Excel::import(new ProcessorsImport, $file);    
    return redirect()->route('processors.index')->with('success', 'Datos importados exitosamente!'); */
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