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
  ];

  public const BRAND_SELECT = [
    'Apple'   => 'Apple',
    'Dell'    => 'Dell',
    'HP'      => 'HP',
    'Lenovo'  => 'Lenovo',
    'Samsung' => 'Samsung',
    'Ibm'     => 'Ibm',
  ];

  // Accessor
  public function getFormattedReferenceAttribute()
  {
    return "{$this->id} - {$this->reference}";
  }

  
	public function scopeFullPrototypes($query)
	{
    return $query->select('id', 'reference') // Selecciona solo lo necesario
      ->orderBy('reference')
      ->get()
      ->pluck('formatted_reference', 'id'); // Usa el accessor
  }
}