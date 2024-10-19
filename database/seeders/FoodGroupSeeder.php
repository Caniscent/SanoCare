<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FoodGroupModel;

class FoodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foodGroups = [];

        $data = [
            // group
            'biji bijian',
            'buah',
            'bumbu',
            'daging dan unggas',
            'lemak minyak',
            'minuman',
            'produk gula',
            'produk laut',
            'sayuran',
            'serealia',
            'susu',
            'telur',
            'umbi berpati'
        ];

        foreach ($data as $item) {
            $foodGroups[] = ['group' => $item];
        }

        FoodGroupModel::insert($foodGroups);

    }
}
