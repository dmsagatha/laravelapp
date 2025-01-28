<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    // Para evitar que Laravel cargue las relaciones lazientes en las consultas (diferidas)
    Model::preventLazyLoading();

    Route::resourceVerbs([
        'create' => 'crear',
        'edit' => 'editar'
    ]);
    
    Validator::extend('without_spaces', function ($attribute, $value) {
      return preg_match('/^\S*$/u', $value); // Rechaza valores con espacios
    });

    Validator::replacer('without_spaces', function ($message, $attribute) {
      return __('El campo :attribute no debe contener espacios en blanco.');
    });
  }
}