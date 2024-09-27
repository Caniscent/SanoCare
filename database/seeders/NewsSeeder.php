<?php

namespace Database\Seeders;

use App\Models\NewsModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NewsModel::create([
            'title' => 'Pola Hidup Sehat untuk Menjaga Berat Badan Ideal',
            'link' => 'https://www.halodoc.com/artikel/pola-hidup-sehat-untuk-menjaga-berat-badan-ideal',
            'type' => 'ideal'
        ]);

        NewsModel::create([
            'title' => '10 Cara Jitu Mempertahankan Berat Badan setelah Diet',
            'link' => 'https://hellosehat.com/nutrisi/berat-badan-turun/tips-mempertahankan-berat-badan/',
            'type' => 'ideal'
        ]);

        NewsModel::create([
            'title' => '8 Cara Menjaga Berat Badan Ideal (Aman dan Efektif)',
            'link' => 'https://doktersehat.com/gaya-hidup/seputar-tips-diet/menjaga-berat-badan/',
            'type' => 'ideal'
        ]);

        NewsModel::create([
            'title' => '7 Tips Menerapkan Pola Makan Sehat yang Mudah Dilakukan',
            'link' => 'https://www.halodoc.com/artikel/7-tips-menerapkan-pola-makan-sehat-yang-mudah-dilakukan',
            'type' => 'ideal'
        ]);

        NewsModel::create([
            'title' => 'Latihan & Olahraga untuk Mendapatkan Tubuh Ideal',
            'link' => 'https://id.wikihow.com/Memiliki-Tubuh-Ideal',
            'type' => 'not_ideal'
        ]);

        NewsModel::create([
            'title' => 'Ini 11 Tips Untuk Membentuk Tubuh Ideal',
            'link' => 'https://cantik.tempo.co/read/834678/ini-11-tips-untuk-membentuk-tubuh-ideal#:~:text=Ini%2011%20Tips%20Untuk%20Membentuk%20Tubuh%20Ideal%201,...%208%208.%20Sarapan%20sehat%20...%20More%20items',
            'type' => 'not_ideal'
        ]);

        NewsModel::create([
            'title' => 'Gerakan Olahraga untuk Bentuk Tubuh Ideal',
            'link' => 'https://www.halodoc.com/artikel/gerakan-olahraga-untuk-bentuk-tubuh-ideal',
            'type' => 'not_ideal'
        ]);

        NewsModel::create([
            'title' => 'Memperbaiki Postur Tubuh, Berikut 6 Tips yang Bisa Dilakukan',
            'link' => 'https://www.alodokter.com/memperbaiki-postur-tubuh-berikut-6-tips-yang-bisa-dilakukan',
            'type' => 'not_ideal'
        ]);
    }
}
