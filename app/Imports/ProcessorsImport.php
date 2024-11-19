<?php

namespace App\Imports;

use App\Models\Processor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProcessorsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
  public function model(array $row)
  {
    return new Processor([
      'servicetag' => $row['service_tag'],
      'mac' => $row['mac'],
      'add_memory_id' => 1
    ]);
  }
    
  public function batchSize(): int
  {
    return 100;
  }
    
  public function chunkSize(): int
  {
    return 100;
  }
}