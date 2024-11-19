<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    // User::factory(10)->create();

    /* User::factory()->create([
      'name' => 'Test User',
      'email' => 'test@example.com',
    ]); */

    $this->call(UserSeeder::class);

    DB::table('add_memories')->insert([
      ['brand' => 'Nanya',     'technology' => 'pc2-4200U-444-12-A1', 'velocity' => '2Rx8', 'capacity' => '8GB',   'slug' => 'nanya_pc2-4200U-444-12-A1'],
      ['brand' => 'Samsung',   'technology' => 'pc3-10600S-9-10-B2',  'velocity' => '2Rx8', 'capacity' => '4GB',   'slug' => 'samsung_pc3-10600S-9-10-B2'],
      ['brand' => 'Kingston',  'technology' => 'pc2-4200U-444-12-B1', 'velocity' => '2Rx8', 'capacity' => '1GB',   'slug' => 'kingston_pc2-4200U-444-12-B1'],
      ['brand' => 'MCT',       'technology' => 'pc2-3200U-333-10-A1', 'velocity' => '1Rx8', 'capacity' => '512MB', 'slug' => 'mct_pc2-3200U-333-10-A1'],
      ['brand' => 'Hynix',     'technology' => 'pc3-10600U-09-10-B0', 'velocity' => '2Rx8', 'capacity' => '8GB',   'slug' => 'hynix_pc3-10600U-09-10-B0'],
      ['brand' => 'Mac',       'technology' => 'pc3-10600U-09-10-B0', 'velocity' => '2Rx8', 'capacity' => '4GB',   'slug' => 'mac_pc3-10600U-09-10-B0']
    ]);
  }
}