<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'rangg',
            'age' => 19,
            'gender' => 'laki-laki',
            'email' => 'darkroyal505@gmail.com',
            'password' => Hash::make('********'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'oujirate',
            'age' => 19,
            'gender' => 'laki-laki',
            'email' => 'oujirate.dev@gmail.com',
            'password' => Hash::make('ouji1110010001010'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
