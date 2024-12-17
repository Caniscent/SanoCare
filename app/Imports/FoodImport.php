<?php

namespace App\Imports;

use App\Models\FoodTypeModel;
use App\Models\CleanFoodModel;
use App\Models\FoodGroupModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
class FoodImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        // dd($rows);
        foreach ($rows as $row) {
            $foodGroup = FoodGroupModel::where('group', $row['group'])->first();
            // dd($foodGroup);
            $foodType = FoodTypeModel::where('type', $row['type'])->first();
            if ($foodGroup && $foodType) {
                CleanFoodModel::create([
                    'food_name'       => $row['foodname'],
                    'food_group_id'   => $foodGroup->id,
                    'food_type_id'    => $foodType->id,
                    'calorie'         => $row['calorie'],
                    'protein'         => $row['protein'],
                    'fats'            => $row['fats'],
                    'carbs'           => $row['carbs'],
                    'fiber'           => $row['fiber'],
                ]);
            }
        }


        // Return null jika data tidak valid
        return null;
    }
}
