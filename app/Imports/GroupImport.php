<?php

namespace App\Imports;

use App\Models\FoodGroupModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GroupImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new FoodGroupModel([
            'group' => $row['group'],
            'description' => $row['description'],
            'status' => $row['status'],
        ]);
    }
}
