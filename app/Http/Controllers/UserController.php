<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index(Request $request): View
  {
    $users = User::query()
      ->when(request()->routeIs('users.trashed'), function ($q) {
        $q->onlyTrashed();
      })
      ->where('email', '!=', 'superadmin@admin.net')
      ->orderBy('name')
      ->get();

    return view('admin.users.index', [
      'view'  => $request->routeIs('users.trashed') ? 'trashed' : 'index',
      'users' => $users
    ]);
  }

  public function massDestroy(Request $request)
  {
    $ids = json_decode($request->input('ids'), true);

    // Validar que se reciban IDs
    if (!is_array($ids) || empty($ids)) {
      return redirect()->back()->withErrors(['message' => 'No se seleccionaron elementos para eliminar.']);
    }

    User::whereIn('id', $ids)->delete();
    
    return redirect()->back()->with([
      'type'    => 'success',
      'message' => 'Registros eliminados exitosamente.'
    ]);
  }

  public function massRestore(Request $request)
  {
    $ids = json_decode($request->input('ids'), true);

    if (!is_array($ids) || empty($ids)) {
      return redirect()->back()->withErrors(['message' => 'No se seleccionaron elementos para restaurar.']);
    }

    DB::table('users')->whereIn('id', $ids)->update(['deleted_at' => null]);

    return redirect()->back()->with([
      'type'    => 'info',
      'message' => 'Registros restaurados exitosamente.'
    ]);
  }

  public function massForceDestroy(Request $request)
  {
    $ids = json_decode($request->input('ids'), true);

    if (!is_array($ids) || empty($ids)) {
      return redirect()->back()->withErrors(['message' => 'No se seleccionaron elementos para eliminar definitivamente.']);
    }

    User::whereIn('id', $ids)->forceDelete();

    return redirect()->back()->with([
      'type'    => 'danger',
      'message' => 'Registros eliminados definitivamente.'
    ]);
  }

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
    $users       = User::orderBy('name')->get();
    $full_names  = $users->sortBy('name')->pluck('name')->unique();
    $countries   = $users->sortBy('country')->pluck('country')->unique();
    $professions = $users->sortBy('jobTitle')->pluck('jobTitle')->unique();

    return view('admin.users.dtFilters', compact('users', 'full_names', 'countries', 'professions'));
  }

  // DataTables y Filtros por el elemento Id
  public function dtFiltersId()
  {
    $users       = User::orderBy('name')->get();
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
}