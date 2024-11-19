<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddMemory extends Model
{
  use HasFactory;

  protected $fillable = [
    'brand',
    'technology',
    'velocity',
    'capacity',
    'slug'
  ];

  public function getRouteKeyName()
  {
    return 'slug';
  }

  public function processors()
  {
    return $this->belongsToMany(Processor::class, 'add_memory_processor')->withTimestamps();
  }
}