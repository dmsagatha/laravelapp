<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index()
  {
    $users = User::all();
    
    return view('users.index', compact('users'));
  }

  public function multiSelect()
  {
    $users = User::orderBy('name')->get();
    
    return view('users.multiSelect', compact('users'));
  }

  public function selectAlpine()
  {
    $users = User::orderBy('name')->get();
    
    return view('users.selectAlpine', compact('users'));
  }
  
  public function create()
  {
  }
  
  public function store(Request $request)
  {
  }
  
  public function show(User $user)
  {
  }
  
  public function edit(User $user)
  {
  }
  
  public function update(Request $request, User $user)
  {
  }
  
  public function destroy(User $user)
  {
  }
}