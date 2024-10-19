<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\testMethodModel;

class testMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        testMethodModel::insert([
            [
                "method" => "Puasa",
                "description" => "Pemeriksaan kadar gula darah saat perut kosong",
            ],
            [
                "method" => "TTGO",
                "description" => "Tes Toleransi Glukosa Oral (TTGO) adalah metode pengukuran glukosa setelah mengonsumsi larutan gula khusus"
            ]
        ]);
    }
}
