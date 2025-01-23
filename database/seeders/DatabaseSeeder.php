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
    // 'reference', 'model_type', 'brand'
    DB::table('prototypes')->insert([
      ['reference' => 'Referencia-01', 'model_type' => 'Escritorio', 'brand' => 'Lenovo'],
      ['reference' => 'Referencia-02', 'model_type' => 'Escritorio', 'brand' => 'Dell'],
      ['reference' => 'Referencia-03', 'model_type' => 'Todo en 1', 'brand' => 'Apple'],
      ['reference' => 'Referencia-04', 'model_type' => 'Portatil', 'brand' => 'Dell'],
      ['reference' => 'Referencia-05', 'model_type' => 'Escritorio', 'brand' => 'HP'],
      ['reference' => 'Referencia-06', 'model_type' => 'Escritorio', 'brand' => 'Apple'],
      ['reference' => 'Referencia-07', 'model_type' => 'Portatil', 'brand' => 'Samsung'],
      ['reference' => 'Referencia-08', 'model_type' => 'Escritorio', 'brand' => 'Acer'],
      ['reference' => 'Referencia-09', 'model_type' => 'Todo en 1', 'brand' => 'Apple'],
      ['reference' => 'Referencia-10', 'model_type' => 'Portatil', 'brand' => 'Dell'],
      ['reference' => 'Referencia-11', 'model_type' => 'Escritorio', 'brand' => 'HP'],
      ['reference' => 'Referencia-12', 'model_type' => 'Todo en 1', 'brand' => 'Apple'],
      ['reference' => 'Referencia-13', 'model_type' => 'Portatil', 'brand' => 'Samsung'],
      ['reference' => 'Referencia-14', 'model_type' => 'Escritorio', 'brand' => 'Samsung'],
      ['reference' => 'Referencia-15', 'model_type' => 'Todo en 1', 'brand' => 'Apple'],
    ]);
  }
}