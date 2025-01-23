<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prototype extends Model
{
  use HasFactory;

  protected $fillable = [
    'reference', 'model_type', 'brand'
  ];

  public function getRouteKeyName()
  {
    return 'reference';
  }

  /**
   * Un Prototipo tiene muchos Procesadores
   */
  public function processors()
  {
    return $this->hasMany(Processor::class);
  }

  protected $withCount = ['processors'];
  
  /**
   * Ordenar globalmente
   */
  protected static function booted()
  {
    static::addGlobalScope(fn ($query) => $query->orderBy('reference'));
  }

  public const MODEL_TYPE_SELECT = [
    'Escritorio' => 'Escritorio',
    'Portatil'   => 'Portatil',
    'Todo en 1'  => 'Todo en 1',
    'Tableta'    => 'Tableta',
  ];

  public const BRAND_SELECT = [
    'Apple'   => 'Apple',
    'Dell'    => 'Dell',
    'HP'      => 'HP',
    'Lenovo'  => 'Lenovo',
    'Samsung' => 'Samsung',
    'Ibm'     => 'Ibm',
  ];
}