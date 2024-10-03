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
      'country'  => 'Colombia',
      'address'  => 'Sur América',
      'password' => Hash::make('superadmin')
    ]);

    User::factory(50)->create();
  }
}