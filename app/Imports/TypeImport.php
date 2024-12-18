<?php

namespace App\Imports;

use App\Models\FoodTypeModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TypeImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new FoodTypeModel([
            'type' => $row['type'],
            'description' => $row['description'],
            'status' => true,
        ]);
    }
}
