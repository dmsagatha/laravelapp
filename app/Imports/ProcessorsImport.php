<?php

namespace App\Imports;

use App\Models\Processor;
use Maatwebsite\Excel\Concerns\ToModel;

class ProcessorsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Processor([
            //
        ]);
    }
}
