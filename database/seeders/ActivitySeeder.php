<?php

namespace Database\Seeders;

use App\Models\ActivityModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ActivityModel::insert([
            [
                "activity" => "Sangat Ringan",
                "description" => "Tidak mempunyai kegiatan fisik sama sekali, seperti menonton TV, membaca, menggunakan komputer atau melakukan kegiatan menetap lainnya selama waktu luang",
            ],
            [
                "activity" => "Ringan",
                "description" => "Aktivitas seperti guru, dokter praktek, ibu rumah tangga, dan pekerja kantor",
            ],
            [
                "activity" => "Sedang",
                "description" => "Aktivitas seperti mahasiswa aktif, pedagang, petani, berenang, berlari, bersepeda, dan lain-lain",
            ],
            [
                "activity" => "Berat",
                "description" => "Aktivitas seperti pekerja pabrik, pekerja bangunan, tentara yang sedang berlatih, atlet",
            ]
            ]);
    }
}
