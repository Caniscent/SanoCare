<?php

namespace Database\Seeders;

use App\Models\ChecksModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $checks = ChecksModel::create([
            // 'user_id' => 1,
            // 'weight_check' => 100,
            // 'height_check' => 180,
        ]);
    }
}
