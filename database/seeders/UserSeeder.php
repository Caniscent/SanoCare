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
        $users = [];

        $data = [
            // [name,age,gender,email,password]
            ['satya',20,'laki-laki','satyabr147@gmail.com','admin123',1],
            ['rangg',19,'laki-laki','darkroyal505@gmail.com','********',2],
            ['oujirate',20,'laki-laki','oujirate.dev@gmail.com','ouji1110010001010',2]
        ];

        foreach ($data as $item) {
            $users[] = [
                'name' => $item[0],
                'age' => $item[1],
                'gender' => $item[2],
                'email' => $item[3],
                'password' => Hash::make($item[4]),
                'role_id' => $item[5],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        User::insert($users);
    }
}
