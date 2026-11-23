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
            return asset('uploads/categories/' . $this->image);
        }

        // If category has products with thumbnails, use the first product thumbnail
        if ($this->relationLoaded('products') && $this->products->isNotEmpty()) {
            $first = $this->products->first(fn($p) => !empty($p->thumbnail));
            if ($first && $first->thumbnail) {
                return asset('uploads/products/' . $first->thumbnail);
            }
        } elseif ($product = $this->products()->whereNotNull('thumbnail')->first()) {
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
