<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FoodTypeModel;

class FoodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = [];

        $typeFood = [
            'single',
            'processed'
        ];

        foreach ($typeFood as $item) {
            $type[] = ['type' => $item];
        }

        FoodTypeModel::insert($type);
    }
}
