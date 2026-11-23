<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'brand_id', 'name', 'slug', 'sku', 'short_description',
        'description', 'price', 'sale_price', 'cost_price', 'stock_quantity',
        'low_stock_threshold', 'weight', 'material', 'metal_type', 'stone_type',
        'is_featured', 'is_new_arrival', 'is_best_seller', 'status',
        'thumbnail', 'meta_title', 'meta_description', 'views',
    ];

    protected $casts = [
        'price'          => 'decimal:2',
        'sale_price'     => 'decimal:2',
        'cost_price'     => 'decimal:2',
        'is_featured'    => 'boolean',
        'is_new_arrival' => 'boolean',
        'is_best_seller' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function approvedReviews()
    {
        return $this->hasMany(Review::class)->where('status', 'approved');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Helpers
    public function getCurrentPriceAttribute(): float
    {
        return $this->sale_price ?? $this->price;
    }

    public function getDiscountPercentageAttribute(): ?int
    {
        if ($this->sale_price && $this->price > 0) {
            return (int) round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return null;
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            if (Str::startsWith($this->thumbnail, ['http://', 'https://'])) {
                return $this->thumbnail;
            }
            if (file_exists(public_path('uploads/products/' . $this->thumbnail))) {
                return asset('uploads/products/' . $this->thumbnail);
            }
            if (file_exists(public_path('images/products/' . $this->thumbnail))) {
                return asset('images/products/' . $this->thumbnail);
            }
            return asset('uploads/products/' . $this->thumbnail);
        }

        // First product image if available
        $firstImage = $this->relationLoaded('images') ? $this->images->first() : $this->images()->first();
        if ($firstImage && $firstImage->image) {
            if (Str::startsWith($firstImage->image, ['http://', 'https://'])) {
                return $firstImage->image;
            }
            if (file_exists(public_path('uploads/products/' . $firstImage->image))) {
                return asset('uploads/products/' . $firstImage->image);
            }
            if (file_exists(public_path('images/products/' . $firstImage->image))) {
                return asset('images/products/' . $firstImage->image);
            }
            return asset('uploads/products/' . $firstImage->image);
        }

        return 'https://images.unsplash.com/photo-1565026057447-bc90a3dceb87?w=700&q=80&fit=crop';
    }

    public function getPrimaryImageAttribute(): string
    {
        return $this->thumbnail_url;
    }

    public function getAverageRatingAttribute(): float
    {
        return $this->approvedReviews()->avg('rating') ?? 0;
    }

    public function isInStock(): bool
    {
        return $this->stock_quantity > 0;
    }

    public function isLowStock(): bool
    {
        return $this->stock_quantity > 0 && $this->stock_quantity <= $this->low_stock_threshold;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeNewArrivals($query)
    {
        return $query->where('is_new_arrival', true);
    }

    public function scopeBestSellers($query)
    {
        return $query->where('is_best_seller', true);
    }
}
