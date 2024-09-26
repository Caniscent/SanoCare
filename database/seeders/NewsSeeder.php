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
            'title' => 'Tips Menjaga Tubuh Ideal dengan Pola Hidup Sehat',
            'link' => 'https://example.com/tips-ideal',
            'type' => 'ideal'
        ]);

        NewsModel::create([
            'title' => 'Bagaimana Olahraga Teratur Bisa Membantu Mempertahankan Tubuh Ideal',
            'link' => 'https://example.com/olahraga-ideal',
            'type' => 'ideal'
        ]);

        // Berita untuk tubuh tidak ideal
        NewsModel::create([
            'title' => 'Langkah-Langkah Mencapai Tubuh Ideal dengan Pola Makan Seimbang',
            'link' => 'https://example.com/pola-makan-ideal',
            'type' => 'not_ideal'
        ]);
    }
}
