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
      'email'    => 'superadmin@admin.net',
      'gender'   => 'f',
      'country'  => 'Colombia',
      'jobTitle' => 'Ingeniero de Sistemas',
      'address'  => 'Sur América',
      'password' => Hash::make('superadmin')
    ]);

    User::factory(100)->create();
  }
}