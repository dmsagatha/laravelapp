<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use HasFactory, Notifiable;
  
  protected $fillable = [
    'name',
    'email',
    'password',
    'username'
  ];

  public function getRouteKeyName()
  {
    return 'username';
  }

  const GENDER_SELECT = [
    'm' => 'Masculino',
    'f' => 'Femenino',
  ];
  
  protected $hidden = [
    'password',
    'remember_token',
  ];
  
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function processors()
  {
    return $this->hasMany(Processor::class);
  }
}
