<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  public function run(): void
  {
    User::factory()->create([
      'name'     => 'Super Admin',
      'username' => 'superadmin',
      'email'    => 'superadmin@admin.net',
      'gender'   => 'f',
      'country'  => 'Colombia',
      'jobTitle' => 'Ingeniero de Sistemas',
      'phone_number'  => '12345678',
      'password' => Hash::make('superadmin')
    ]);

    User::factory()->create([
      'name'     => 'Usuario 1',
      'username' => 'usuario1',
      'email'    => 'usuario1@tmp.com',
      'gender'   => 'f',
      'country'  => 'Brasil',
      'jobTitle' => 'Ingeniero de Sistemas',
      'phone_number'  => '87654321',
      'password' => Hash::make('usuario1')
    ]);

    User::factory()->create([
      'name'     => 'Usuario 2',
      'username' => 'usuario2',
      'email'    => 'usuario2@tmp.com',
      'gender'   => 'f',
      'country'  => 'Ecuador',
      'jobTitle' => 'Ingeniero de Sistemas',
      'phone_number'  => '741258963',
      'password' => Hash::make('usuario2')
    ]);

    User::factory(200)->create();
  }
}