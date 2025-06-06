<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image_path',
        'alt_text',
        'sort_order',
        'is_primary'
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    // Relazioni
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Helper per URL completo
    public function getUrlAttribute()
    {
        return asset('uploads/products/' . $this->image_path);
    }
}
