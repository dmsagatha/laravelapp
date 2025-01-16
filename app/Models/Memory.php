<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
  use HasFactory;

  protected $fillable = [
    'serial', 'capacity', 'technology', 'velocity', 'purchase_date', 'sale_date', 'birthdate'
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
}