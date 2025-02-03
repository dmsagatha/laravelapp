<?php

namespace App\Imports;

use App\Models\{Processor, User, Memory, Prototype};
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\{Importable, SkipsErrors, SkipsOnError, SkipsFailures, SkipsOnFailure, WithHeadingRow, WithValidation, WithBatchInserts, WithChunkReading};
use Maatwebsite\Excel\Concerns\ToCollection;

class ProcessorsImport implements ToCollection,
  WithHeadingRow,
  SkipsOnError,
  WithValidation,
  SkipsOnFailure,
  WithBatchInserts,
  WithChunkReading
{
  use Importable, SkipsErrors, SkipsFailures;

  private $users, $prototypes;

  public function __construct()
  {
    $this->users = User::pluck('id', 'email');
    $this->prototypes = Prototype::pluck('id', 'reference');
  }

  public function collection(Collection $rows)
  {
    foreach ($rows as $row) {
      // Crear o encontrar el Procesador
      $processorData = Processor::firstOrCreate(
        ['servicetag' => $row['service_tag']],
        [
          'servicetag'   => trim($row['service_tag']),
          'mac'          => trim($row['mac']),
          'user_id'      => $this->users[$row['usuario']],
          'prototype_id' => $this->prototypes[$row['prototype_reference']]
        ]
      );

      // Manejar Memory y la tabla pivote solo si están presentes `serial` y `quantity`
      // Archivo de ejemplo: public/importar/processors.xlsx
      if (!is_null($row['memories'])) {
        $memories = Memory::whereIn('serial', explode(',', $row['memories']))->get();

        foreach ($memories as $memory) {
          $processorData->memories()->attach($memory->id, ['quantity' => $row['quantity']]);
        }
      }
    }
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