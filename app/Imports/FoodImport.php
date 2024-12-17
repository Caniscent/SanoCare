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
        foreach ($rows as $row) {
            $foodGroup = FoodGroupModel::where('group', $row['FoodGroup'])->first();
            $foodType = FoodTypeModel::where('type', $row['FoodType'])->first();
        }
        if ($foodGroup && $foodType) {
            return new CleanFoodModel([
                'food_name'       => $row['food_name'],
                'food_group_id'   => $foodGroup->id,
                'food_type_id'    => $foodType->id,
                'calorie'         => $row['calorie'],
                'protein'         => $row['protein'],
                'fats'            => $row['fats'],
                'carbs'           => $row['carbs'],
                'fiber'           => $row['fiber'],
            ]);
        }

        // Return null jika data tidak valid
        return null;
    }
}
