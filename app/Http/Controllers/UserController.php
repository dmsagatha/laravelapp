<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    // return redirect()->back()->with('status', 'Usuarios eliminados exitosamente.');
    return redirect()->back()->with([
      'type'    => 'danger',
      'message' => 'Registros seleccionados eliminados exitosamente.'
    ]);
  }

  public function restoreAll(Request $request)
  {
    $ids = $request->input('ids'); // Recibe los IDs a restaurar

    if (!$ids) {
      return response()->json(['message' => 'No se seleccionaron elementos para restaurar.'], 400);
    }

    // User::withTrashed()->whereIn('id', $ids)->restore();
    User::onlyTrashed()->whereIn('id', $ids)->restore();

    return response()->json(['message' => 'Elementos restaurados con éxito.']);

    /* User::onlyTrashed()->restore();

    Session()->flash('statusCode', 'info');

    return to_route('admin.users.index')->withStatus('Todos los registro fueron restaurados exitosamente!.'); */
  }

  public function massForceDestroy(Request $request)
  {
    $ids = $request->input('ids');
    User::onlyTrashed()->whereIn('id', $ids)->forceDelete();
    
    return redirect()->back()->with('success', 'Registros eliminados definitivamente.');
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
}