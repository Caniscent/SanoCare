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
                'title' => 'Belajar Laravel Dasar',
                'slug' => Str::slug('Belajar Laravel Dasar'),
                'content' => 'Artikel ini membahas dasar-dasar penggunaan Laravel untuk pengembangan web.',
                'image' => 'images/laravel.jpg',
                // 'author_id' => 1,
                'status' => 'published',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Apa Itu Framework?',
                'slug' => Str::slug('Apa Itu Framework?'),
                'content' => 'Framework adalah kerangka kerja yang mempermudah proses pengembangan aplikasi.',
                'image' => 'images/framework.jpg',
                // 'author_id' => 2,
                'status' => 'draft',
                'published_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tips Membuat Artikel SEO',
                'slug' => Str::slug('Tips Membuat Artikel SEO'),
                'content' => 'Artikel ini memberikan tips tentang cara membuat artikel yang ramah SEO.',
                'image' => 'images/seo.jpg',
                // 'author_id' => 3,
                'status' => 'published',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
