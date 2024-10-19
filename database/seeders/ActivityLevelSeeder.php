<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ActivityLevelModel;

class ActivityLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $activityLevels = [];

        $data = [
            // [level,description]
            ['Sangat Ringan','Tidak mempunyai kegiatan fisik sama sekali, seperti menonton TV, membaca, menggunakan komputer atau melakukan kegiatan menetap lainnya selama waktu luang'],
            ['Ringan','Aktivitas seperti guru, dokter praktek, ibu rumah tangga, dan pekerja kantor'],
            ['Sedang','Aktivitas seperti mahasiswa aktif, pedagang, petani, berenang, berlari, bersepeda, dan lain-lain'],
            ['Berat','Aktivitas seperti pekerja pabrik, pekerja bangunan, tentara yang sedang berlatih, atlet'],
        ];

        foreach ($data as $item) {
            $activityLevels[] = [
                'level' => $item[0],
                'description' => $item[1],
            ];
        }

        ActivityLevelModel::insert($activityLevels);

    }
}
