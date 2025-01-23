<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processor extends Model
{
  use HasFactory;

  protected $fillable = [
    'mac', 'servicetag', 'user_id', 'prototype_id'
  ];

  public function getRouteKeyName()
  {
    return 'servicetag';
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function addMemories()
  {
    return $this->belongsToMany(AddMemory::class, 'add_memory_processor')->withPivot('quantity_addmem');
  }
  
  public function prototype(): BelongsTo
  {
    return $this->belongsTo(Prototype::class)->withDefault();
  }
}