<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function dataTablesJQ()
  {
    $users = User::orderBy('name')->get();
    
    return view('users.dataTablesJQ', compact('users'));
  }

  public function dtTailwindcss()
  {
    $users = User::orderBy('name')->get();
    
    return view('users.dtTailwindcss', compact('users'));
  }

  public function select2JQ()
  {
    $users = User::orderBy('name')->get();
    
    return view('users.select2JQ', compact('users'));
  }

  public function dttheme()
  {
    $users = User::orderBy('name')->get();
    
    return view('users.dttheme', compact('users'));
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