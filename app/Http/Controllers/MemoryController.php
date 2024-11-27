<?php

namespace App\Http\Controllers;

use App\Models\Memory;
use Illuminate\View\View;
use Illuminate\Http\Request;

class MemoryController extends Controller
{
  public function index(): View
  {
    $memories = Memory::orderBy('serial')->get();

    return view('admin.memories.index', compact('memories'));
  }
}