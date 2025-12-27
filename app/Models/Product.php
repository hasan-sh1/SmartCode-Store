<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'category_id', 'subcategory_id', 'name', 'slug', 'sku', 'description', 'price', 'stock', 'image_path', 'is_active',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // يوفر رابط صورة صالح لواجهة العرض
   public function getImageUrlAttribute(): string
{
    $path = $this->image_path;
    if (!$path) {
        return 'https://via.placeholder.com/600x400?text=صورة+المنتج';
    }
    if (Str::startsWith($path, ['http://', 'https://'])) {
        return $path;
    }
    return asset('storage/' . ltrim($path, '/'));
}
}
