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
    $file = $request->file('import_file');

    // Excel::import(new ProcessorsImport, 'procesadores.xlsx');
    Excel::import(new ProcessorsImport, $file);
    
    return redirect('/procesadores')->with('success', 'Datos importadores exitosamente!');
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