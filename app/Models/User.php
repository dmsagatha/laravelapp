<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasFactory, Notifiable, SoftDeletes;
  
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
  
	public function scopefullUsers($query)
	{
    return $query->where('id', '!=', '1')
      ->select(
        'users.id',
        DB::raw("CONCAT(users.name, ' - ', users.id) AS fullUsers")
      )
      ->orderBy('fullUsers')
      ->get()
      ->pluck('fullUsers', 'id');
  }
}