<?php

namespace App\Imports;

use App\Models\Processor;
use App\Models\User;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProcessorsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation, SkipsOnFailure
{
  private $users;

  public function __construct()
  {
    $this->users = User::pluck('id', 'email');
  }

  public function model(array $row)
  {
    return new Processor([
      'servicetag' => $row['service_tag'],
      'mac' => $row['mac'],
      'user_id' => $this->users[$row['usuario']]
    ]);
  }

  public function rules(): array
  {
    return [
      '*.service_tag' => ['required', 'string', 'max:255', 'unique:processors,servicetag'],
      '*.mac' => ['required', 'string', 'max:255', 'unique:processors,mac'],
      '*.usuario' => ['required', 'email', 'exists:users,email']
    ];
  }

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