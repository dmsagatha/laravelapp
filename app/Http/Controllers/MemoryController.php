<?php

namespace App\Http\Controllers;

use App\Models\Memory;
use Illuminate\View\View;
use App\Http\Requests\MemoryRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MemoryController extends Controller
{
  public function index(): View
  {
    $memories = Memory::orderBy('serial')->get();

    return view('admin.memories.index', compact('memories'));
  }

  public function create(): View
  {
    return view('admin.memories.createUpdate');
  }

  public function store(MemoryRequest $request): RedirectResponse
  {   
    Memory::create($request->validated());
        
    return Redirect::route('memories.index')->with('status', 'Registro creado satisfactoriamente!');
  }

  public function edit(Memory $memory): View
  {
    return view('admin.memories.createUpdate', compact('memory'));
  }

  public function update(MemoryRequest $request, Memory $memory): RedirectResponse
  {   
    $memory->update($request->validated());
        
    return Redirect::route('memories.index')->with('status', 'Registro actualizado satisfactoriamente!');
  }
}