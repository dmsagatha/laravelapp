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

    DB::table('memories')->insert([
      ['serial' => 'SN001', 'capacity' => '8 GB', 'technology'  => 'DDR3', 'velocity' => '1066', 'initial_warranty' => '2022-01-01', 'final_warranty' => '2024-12-31', 'days_warranty' => 365],
      ['serial' => 'SN002', 'capacity' => '32 GB', 'technology' => 'DDR4', 'velocity' => '1866', 'initial_warranty' => '2022-01-01', 'final_warranty' => '2024-12-31', 'days_warranty' => 365],
      ['serial' => 'SN003', 'capacity' => '16 GB', 'technology' => 'DDR3', 'velocity' => '1600', 'initial_warranty' => '2022-01-01', 'final_warranty' => '2024-12-31', 'days_warranty' => 365],
      ['serial' => 'SN004', 'capacity' => '32 GB', 'technology' => 'DDR5', 'velocity' => '5120', 'initial_warranty' => '2022-01-01', 'final_warranty' => '2024-12-31', 'days_warranty' => 365],
      ['serial' => 'SN005', 'capacity' => '64 GB', 'technology' => 'DDR4', 'velocity' => '2666', 'initial_warranty' => '2022-01-01', 'final_warranty' => '2024-12-31', 'days_warranty' => 365],
      ['serial' => 'SN006', 'capacity' => '16 GB', 'technology' => 'DDR3', 'velocity' => '2133', 'initial_warranty' => '2022-01-01', 'final_warranty' => '2024-12-31', 'days_warranty' => 365]
    ]);

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