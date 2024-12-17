<?php

namespace App\Exports;

use App\Models\CleanFoodModel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FoodExport implements FromQuery, WithHeadings, WithMapping
{
    private $rowNumber = 0;

    public function query()
    {
        return CleanFoodModel::query()->select('food_name','food_group_id', 'food_type_id','calorie',
        'protein',
        'fats',
        'carbs',
        'fiber' );
    }

    public function headings(): array
    {
        return [
            'No',
            'FoodName',
            'Group',
            'Type',
            'Calorie',
            'Protein',
            'Fats',
            'Carbs',
            'Fiber'
        ];
    }

    public function map($row): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $row->food_name,
            $row->foodGroup->group,
            $row->foodType->type,
            $row->calorie,
            $row->protein,
            $row->fats,
            $row->carbs,
            $row->fiber,
        ];
    }
}
