<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'code_url', 'price', 'attachment_path', 'is_active',
    ];

    public function getImageUrlAttribute(): string
    {
        $path = $this->attachment_path;
        if (!$path) {
            return 'https://via.placeholder.com/600x400?text=صورة+الخدمة';
        }
        if (Str::startsWith($path, ['http://','https://'])) {
            return $path;
        }
        return asset('storage/' . ltrim($path, '/'));
    }
}
