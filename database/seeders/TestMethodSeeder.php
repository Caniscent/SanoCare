<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TestMethodModel;

class TestMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $methodTest = [];

        $data = [
            // [method,description]
            ['Puasa','Pemeriksaan kadar gula darah saat perut kosong'],
            ['TTGO','Tes Toleransi Glukosa Oral (TTGO) adalah metode pengukuran glukosa setelah mengonsumsi larutan gula khusus']
        ];

        foreach ($data as $item) {
            $methodTest[] = [
                'method' => $item[0],
                'description' => $item[1]
            ];
        }

        TestMethodModel::insert($methodTest);
    }
}
