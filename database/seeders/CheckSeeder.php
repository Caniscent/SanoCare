<?php

namespace Database\Seeders;

use App\Models\CheckModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $check = CheckModel::create([
            'weight_check' => 100,
            'height_check' => 180,
        ]);
    }
}
