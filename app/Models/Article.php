<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    protected $casts = [
        'published_at' => 'datetime',
    ];
    
    protected $guarded = [
        "id",
        "timestamps"
    ];
    protected static function booted()
    {
        static::creating(function ($article) {
            // Membuat slug secara otomatis saat artikel baru dibuat
            $article->slug = Str::slug($article->title);
        });

        static::updating(function ($article) {
            // Membuat slug secara otomatis saat artikel diperbarui
            $article->slug = Str::slug($article->title);
        });
    }
}
