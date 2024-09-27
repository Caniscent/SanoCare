<?php

namespace Database\Seeders;

use App\Models\HabitModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HabitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HabitModel::create([
            'user_id' => 1,
            'name' => 'Exercise',
            'description' => 'Daily morning workout for 30 minutes.',
            'frequency' => 'daily',
            'status' => false
        ]);
    }
}
