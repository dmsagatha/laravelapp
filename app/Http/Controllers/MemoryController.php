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
    return view('admin.memories.createUpdate', [
      'memory'       => new Memory(),
      'capacities'   => Memory::CAPACITY_SELECT,
      'technologies' => Memory::TECHNOLOGY_SELECT,
      'velocities'   => Memory::VELOCITY_SELECT,
    ]);
  }

  public function store(MemoryRequest $request): RedirectResponse
  {   
    Memory::create($request->validated());
        
    return Redirect::route('memories.index')->with('status', 'Registro creado satisfactoriamente!');
  }

  public function edit(Memory $memory): View
  {
    return view('admin.memories.createUpdate', [
      'memory'       => $memory,
      'capacities'   => Memory::CAPACITY_SELECT,
      'technologies' => Memory::TECHNOLOGY_SELECT,
      'velocities'   => Memory::VELOCITY_SELECT[$memory->technology],
    ]);
  }

  public function update(MemoryRequest $request, Memory $memory): RedirectResponse
  {   
    $memory->update($request->validated());
        
    return Redirect::route('memories.index')->with('status', 'Registro actualizado satisfactoriamente!');
  }
}