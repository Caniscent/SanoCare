<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\activityLevelModel;

class activityLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        activityLevelModel::insert([
            [
                "level" => "Sangat Ringan",
                "description" => "Tidak mempunyai kegiatan fisik sama sekali, seperti menonton TV, membaca, menggunakan komputer atau melakukan kegiatan menetap lainnya selama waktu luang",
            ],
            [
                "level" => "Ringan",
                "description" => "Aktivitas seperti guru, dokter praktek, ibu rumah tangga, dan pekerja kantor",
            ],
            [
                "level" => "Sedang",
                "description" => "Aktivitas seperti mahasiswa aktif, pedagang, petani, berenang, berlari, bersepeda, dan lain-lain",
            ],
            [
                "level" => "Berat",
                "description" => "Aktivitas seperti pekerja pabrik, pekerja bangunan, tentara yang sedang berlatih, atlet",
            ],

        ]);
    }
}
