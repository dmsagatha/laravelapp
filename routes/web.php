<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\{UserController, ProcessorController, MemoryController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth', 'verified']], function ()
{
  Route::prefix('usuarios')->name('users.')->controller(UserController::class)->group(function () {
    Route::get('dataTablesJQ', 'dataTablesJQ')->name('dataTablesJQ');
    Route::get('dtTailwindcss', 'dtTailwindcss')->name('dtTailwindcss');
    Route::get('dtFiltros', 'dtFilters')->name('dtFilters');
    Route::get('dtFiltrosId', 'dtFiltersId')->name('dtFiltersId');
    Route::get('select2JQ', 'select2JQ')->name('select2JQ');

    Route::get('DataTablesTemas', 'dttheme')->name('dttheme');

    Route::get('papelera', 'index')->name('trashed');
    Route::delete('eliminar-en-masa', 'massDestroy')->name('massDestroy');

  });

  Route::resource('/usuarios', UserController::class)
    ->only(['index', 'destroy'])
    ->parameters(['usuarios' => 'user'])
    ->names('users');

  Route::prefix('procesadores')->name('processors.')->controller(ProcessorController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('importar', 'import')->name('import');
  });

  Route::resource('memorias', MemoryController::class)
    ->parameters(['memorias' => 'memory'])
    ->names('memories')->except(['show']);
});