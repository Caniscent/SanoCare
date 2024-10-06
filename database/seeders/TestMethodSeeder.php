<?php

namespace Database\Seeders;

use App\Models\TestMethodModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TestMethodModel::insert([
            [
                "method" => "Puasa",
                "description" => "Pemeriksaan kadar gula darah saat perut kosong"
            ],
            [
                "method" => "TTGO",
                "description" => "Tes Toleransi Glukosa Oral (TTGO) adalah metode pengukuran glukosa setelah mengonsumsi larutan gula khusus"
            ]
        ]);
    }
}
