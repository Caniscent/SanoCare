<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Pentingnya Olahraga untuk Kesehatan Tubuh',
                'slug' => Str::slug('Pentingnya Olahraga untuk Kesehatan Tubuh'),
                'content' => 'Olahraga memiliki banyak manfaat seperti meningkatkan kebugaran fisik, mengurangi risiko penyakit kronis, dan meningkatkan kesehatan mental. Disarankan untuk berolahraga minimal 30 menit setiap hari.',
                'image' => 'images/olahraga.jpg',
                'status' => 'published',
                'published_at' => now()->subMonths(11),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tips Pola Makan Sehat untuk Hidup Lebih Baik',
                'slug' => Str::slug('Tips Pola Makan Sehat untuk Hidup Lebih Baik'),
                'content' => 'Pola makan sehat mencakup konsumsi makanan bergizi seimbang seperti sayuran, buah-buahan, protein, dan lemak sehat. Hindari makanan olahan dan gula berlebih.',
                'image' => 'images/pola-makan.jpg',
                'status' => 'published',
                'published_at' => now()->subMonths(11),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Manfaat Tidur Cukup untuk Kesehatan',
                'slug' => Str::slug('Manfaat Tidur Cukup untuk Kesehatan'),
                'content' => 'Tidur yang cukup berperan penting dalam pemulihan tubuh, mengurangi stres, dan meningkatkan produktivitas harian. Orang dewasa memerlukan 7-9 jam tidur berkualitas setiap malam.',
                'image' => 'images/tidur-sehat.jpg',
                'status' => 'published',
                'published_at' => now()->subMonths(11),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cara Mengelola Stres untuk Hidup Lebih Sehat',
                'slug' => Str::slug('Cara Mengelola Stres untuk Hidup Lebih Sehat'),
                'content' => 'Mengelola stres dapat dilakukan dengan meditasi, berolahraga, menjaga pola tidur, dan berbicara dengan orang terdekat. Hindari kebiasaan buruk seperti merokok dan konsumsi alkohol.',
                'image' => 'images/kelola-stres.jpg',
                'status' => 'published',
                'published_at' => now()->subMonths(8),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pentingnya Vaksinasi untuk Perlindungan Diri',
                'slug' => Str::slug('Pentingnya Vaksinasi untuk Perlindungan Diri'),
                'content' => 'Vaksinasi membantu melindungi tubuh dari berbagai penyakit menular seperti flu, hepatitis, dan COVID-19. Pastikan vaksinasi rutin sesuai anjuran dokter.',
                'image' => 'images/vaksinasi.jpg',
                'status' => 'published',
                'published_at' => now()->subMonths(8),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Efek Positif Minum Air Putih yang Cukup',
                'slug' => Str::slug('Efek Positif Minum Air Putih yang Cukup'),
                'content' => 'Minum air putih membantu menjaga hidrasi tubuh, meningkatkan fungsi organ, dan mengeluarkan racun dari dalam tubuh. Minumlah minimal 8 gelas air putih sehari.',
                'image' => 'images/air-putih.jpg',
                'status' => 'published',
                'published_at' => now()->subMonths(6),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pentingnya Menjaga Kesehatan Mental',
                'slug' => Str::slug('Pentingnya Menjaga Kesehatan Mental'),
                'content' => 'Kesehatan mental yang baik berpengaruh pada kualitas hidup. Luangkan waktu untuk hobi, meditasi, atau aktivitas yang membuat bahagia untuk menjaga kesehatan mental.',
                'image' => 'images/kesehatan-mental.jpg',
                'status' => 'published',
                'published_at' => now()->subMonths(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cara Menjaga Imunitas Tubuh di Musim Pancaroba',
                'slug' => Str::slug('Cara Menjaga Imunitas Tubuh di Musim Pancaroba'),
                'content' => 'Untuk menjaga imunitas tubuh, konsumsi vitamin C, olahraga rutin, tidur cukup, dan kelola stres agar tubuh tetap sehat di musim pancaroba.',
                'image' => 'images/imunitas.jpg',
                'status' => 'published',
                'published_at' => now()->subMonths(4),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Manfaat Buah dan Sayur untuk Kesehatan',
                'slug' => Str::slug('Manfaat Buah dan Sayur untuk Kesehatan'),
                'content' => 'Buah dan sayur kaya akan serat, vitamin, dan antioksidan yang membantu menjaga kesehatan jantung, pencernaan, dan mengurangi risiko penyakit kronis.',
                'image' => 'images/buah-sayur.jpg',
                'status' => 'published',
                'published_at' => now()->subMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kebiasaan Buruk yang Harus Dihindari untuk Sehat',
                'slug' => Str::slug('Kebiasaan Buruk yang Harus Dihindari untuk Sehat'),
                'content' => 'Kebiasaan buruk seperti merokok, kurang tidur, dan konsumsi makanan cepat saji dapat merusak kesehatan. Gantilah dengan pola hidup yang lebih sehat.',
                'image' => 'images/kebiasaan-sehat.jpg',
                'status' => 'published',
                'published_at' => now()->subMonths(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Panduan Menjalani Gaya Hidup Sehat Sehari-hari',
                'slug' => Str::slug('Panduan Menjalani Gaya Hidup Sehat Sehari-hari'),
                'content' => 'Mulailah dengan rutin berolahraga, makan makanan bergizi, tidur cukup, dan menghindari stres untuk menjalani hidup yang sehat.',
                'image' => 'images/gaya-hidup.jpg',
                'status' => 'published',
                'published_at' => now()->subMonth(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
