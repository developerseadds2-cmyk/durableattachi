<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    protected $fillable = [
        'title',
        'type',
        'badge_text',
        'headline',
        'description',
        'coupon_code',
        'discount_percentage',
        'button_text',
        'button_url',
        'image',
        'target_type',
        'category_id',
        'product_id',
        'delay_seconds',
        'show_once_per_session',
        'starts_at',
        'ends_at',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_once_per_session' => 'boolean',
        'discount_percentage' => 'integer',
        'delay_seconds' => 'integer',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) return null;
        if (str_starts_with($this->image, 'http')) return $this->image;
        return asset('uploads/popups/' . $this->image);
    }
}
