<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  // Selección múltiple
  public function dataTablesJQ()
  {
    $users = User::orderBy('name')->get();
    
    return view('admin.users.dataTablesJQ', compact('users'));
  }

  // DataTables con Tailwind Css - Encabezados complejos
  public function dtTailwindcss()
  {
    $users = User::orderBy('name')->get();
    
    return view('admin.users.dtTailwindcss', compact('users'));
  }

  // DataTables y Filtros por número de columna
  public function dtFilters()
  {
    $users = User::orderBy('name')->get();
    $full_names  = $users->sortBy('name')->pluck('name')->unique();
    $countries   = $users->sortBy('country')->pluck('country')->unique();
    $professions = $users->sortBy('jobTitle')->pluck('jobTitle')->unique();
    
    return view('admin.users.dtFilters', compact('users', 'full_names', 'countries', 'professions'));
  }

  // DataTables y Filtros por el elemento Id
  public function dtFiltersId()
  {
    $users = User::orderBy('name')->get();
    $full_names  = $users->sortBy('name')->pluck('name')->unique();
    $countries   = $users->sortBy('country')->pluck('country')->unique();
    $professions = $users->sortBy('jobTitle')->pluck('jobTitle')->unique();
    
    return view('admin.users.dtFiltersId', compact('users', 'full_names', 'countries', 'professions'));
  }

  // Selección múltiple
  public function select2JQ()
  {
    $users = User::orderBy('name')->get();
    
    return view('admin.users.select2JQ', compact('users'));
  }

  public function dttheme()
  {
    $users = User::orderBy('name')->get();
    
    return view('admin.users.dttheme', compact('users'));
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