<?php

namespace App\Imports;

use App\Models\{Processor, User, AddMemory};
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Throwable;

class ProcessorsImport implements ToModel, 
  WithHeadingRow,
  SkipsOnError,
  WithValidation,
  SkipsOnFailure,
  WithBatchInserts,
  WithChunkReading
{
  use Importable, SkipsErrors, SkipsFailures;

  private $users;

  public function __construct()
  {
    $this->users = User::pluck('id', 'email');
  }

  public function model(array $row)
  {
    // Crear o encontrar el producto
    $processorData = Processor::firstOrCreate(
      ['servicetag' => $row['service_tag']],
      [
        'servicetag' => trim($row['service_tag']),
        'mac'        => trim($row['mac']),
        'user_id'    => $this->users[$row['usuario']
      ]
    ]);


    // Procesar los slugs y cantidades de memoria
    $addMemorySlug = explode(',', $row['slug']);
    $addMemory = AddMemory::where('slug', $addMemorySlug)->first();

    if ($addMemory) {
      $processorData->addMemories()->attach($addMemory->id, ['quantity_addmem' => $row['quantity_mem']]);
    }



    /* return new Processor([
      'servicetag' => $row['service_tag'],
      'mac'        => $row['mac'],
      'user_id'    => $this->users[$row['usuario']]
    ]); */
  }

  public function rules(): array
  {
    return [
      '*.service_tag' => ['required', 'string', 'max:255', 'unique:processors,servicetag'],
      '*.mac'         => ['required', 'string', 'max:255', 'unique:processors,mac'],
      '*.usuario'     => ['required', 'email', 'exists:users,email']
    ];
  }

  /* public function onFailure(Failure ...$failure)
  {
  } */

  // SkipsOnError
  /* public function onError(Throwable $error)
  {
  } */

  /* public function customValidationAttributes()
  {
    return [
      'service_tag' => 'El campo ServiceTag es obligatorio',
      'mac' => 'El campo Mac es obligatorio',
      'usuario' => 'El campo usuario es obligatorio',
    ];
  } */

  public function batchSize(): int
  {
    return 100;
  }

  public function chunkSize(): int
  {
    return 100;
  }
}