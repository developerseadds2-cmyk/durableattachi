<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id', 'name', 'slug', 'description', 'image',
        'icon', 'sort_order', 'status', 'meta_title', 'meta_description',
    ];

    protected $casts = ['status' => 'boolean'];

    // Auto-generate slug
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('sort_order');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            // If already a full URL
            if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
                return $this->image;
            }
            // If path already starts with uploads/ or images/
            if (str_starts_with($this->image, 'uploads/') || str_starts_with($this->image, 'images/')) {
                return asset($this->image);
            }
            // Standard category upload path
            if (file_exists(public_path('uploads/categories/' . $this->image))) {
                return asset('uploads/categories/' . $this->image);
            }
            // Direct public path check
            if (file_exists(public_path($this->image))) {
                return asset($this->image);
            }
            return asset('uploads/categories/' . $this->image);
        }

        // If category has products with thumbnails, use the first product thumbnail
        if ($this->relationLoaded('products') && $this->products->isNotEmpty()) {
            $first = $this->products->first(fn($p) => !empty($p->thumbnail));
            if ($first && $first->thumbnail) {
                if (str_starts_with($first->thumbnail, 'http://') || str_starts_with($first->thumbnail, 'https://')) {
                    return $first->thumbnail;
                }
                return asset('uploads/products/' . $first->thumbnail);
            }
        } elseif ($product = $this->products()->whereNotNull('thumbnail')->first()) {
            if (str_starts_with($product->thumbnail, 'http://') || str_starts_with($product->thumbnail, 'https://')) {
                return $product->thumbnail;
            }
            return asset('uploads/products/' . $product->thumbnail);
        }

        // Fallback placeholder
        return 'https://images.unsplash.com/photo-1608248597359-009139268393?w=500&q=80&fit=crop';
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }
}
