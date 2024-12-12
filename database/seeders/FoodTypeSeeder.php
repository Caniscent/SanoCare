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
            // type => [description, status]
            'single' => ['Makanan yang tidak diproses atau hanya melalui proses minimal.', true],
            'processed' => ['Makanan yang telah diproses atau diolah dengan bahan tambahan.', true]
        ];
    
        foreach ($typeFood as $typeName => [$description, $status]) {
            $type[] = [
                'type' => $typeName,
                'description' => $description,
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        FoodTypeModel::insert($type);
    }
    
}
