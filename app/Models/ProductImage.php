<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'image', 'alt_text', 'sort_order', 'is_primary'];

    protected $casts = ['is_primary' => 'boolean'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getUrlAttribute(): string
    {
        if (\Illuminate\Support\Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        if (file_exists(public_path('uploads/products/' . $this->image))) {
            return asset('uploads/products/' . $this->image);
        }
        if (file_exists(public_path('images/products/' . $this->image))) {
            return asset('images/products/' . $this->image);
        }
        return asset('uploads/products/' . $this->image);
    }
}
