<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
    Route::get('/', 'dataTablesJQ')->name('dataTablesJQ');
    Route::get('select2JQ', 'select2JQ')->name('select2JQ');
  });
});