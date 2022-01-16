<?php

namespace App\Imports;

use App\Models\AvailabilityRecordDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RecDetailImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }
    
    public function model(array $row)
    {
        return new AvailabilityRecordDetail([
            'device_id  ' => $row[7],
            'ou_id' => $row[3]          
        ]);
    }
}
