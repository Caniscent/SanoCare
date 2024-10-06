<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            //untuk menggunakan seeder pertama nyalakan dulu news dan user setelah itu
            //di comment lagi dan nyalakan check dan habit

            // NewsSeeder::class,
            // UserSeeder::class,
            // CheckSeeder::class,
            // HabitSeeder::class,
            ActivitySeeder::class,
            TestMethodSeeder::class,
        ]);
    }
}
