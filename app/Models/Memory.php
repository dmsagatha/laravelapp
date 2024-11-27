<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
  use HasFactory;

  protected $fillable = [
    'serial', 'capacity'
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
}