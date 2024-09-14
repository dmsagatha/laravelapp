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
      'password' => Hash::make('superadmin')
    ]);

    User::factory(10)->create();
  }
}