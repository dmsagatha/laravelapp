<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processor extends Model
{
  use HasFactory;

  protected $fillable = [
    'mac', 'servicetag'
  ];

  public function getRouteKeyName()
  {
    return 'servicetag';
  }

  public function addMemories()
  {
    return $this->belongsToMany(AddMemory::class, 'add_memory_processor')->withPivot('quantity_addmem')->withTimestamps();
  }
}