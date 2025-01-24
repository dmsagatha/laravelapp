<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
  use HasFactory;

  protected $fillable = [
    'serial', 'capacity', 'technology', 'velocity', 'initial_warranty', 'final_warranty', 'days_warranty', 'birthdate'
  ];

  public function getRouteKeyName()
  {
    return 'serial';
  }

  const CAPACITY_SELECT = [
    '64 GB'  => '64 GB',
    '32 GB'  => '32 GB',
    '16 GB'  => '16 GB',
    '8 GB'   => '8 GB',
    '4 GB'   => '4 GB',
  ];

  const TECHNOLOGY_SELECT = [
    'DDR3' => 'DDR3',
    'DDR4' => 'DDR4',
    'DDR5' => 'DDR5',
  ];

  const VELOCITY_SELECT = [
    'DDR3' => ['800', '1066', '1333', '1600', '1866', '2133'],
    'DDR4' => ['1600', '1866', '2133', '2400', '2666', '2933', '3200'],
    'DDR5' => ['3200', '3600', '4000', '4400', '4800', '5000', '5120', '5200', '5300', '5600', '6000', '6400'],
  ];

  public function processors()
  {
    return $this->belongsToMany(Processor::class, 'memory_processor')
                ->withPivot('quantity')
                ->withTimestamps();
  }

  public static function boot()
  {
      parent::boot();

      static::saving(function ($model) {
        $model->days_warranty = $model->calculateWarrantyDays();
      });
  }
  
  /**
   * Calcula los días restantes de garantía.🥳
   *
   * @return int
   */
  public function calculateWarrantyDays(): int
  {
    $now = Carbon::now()->startOfDay(); // Fecha actual (sin horas).
    $final_warranty = Carbon::parse($this->final_warranty)->startOfDay();

    // Si la fecha de finalización es menor a la fecha actual, retorna 0.
    if ($final_warranty->lt($now)) {
      return 0;
    }

    // Retorna la diferencia de días de manera positiva.
    return $now->diffInDays($final_warranty);
  }
}