<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'description', 'image', 'mobile_image',
        'button_text', 'button_link', 'position', 'sort_order', 'status',
    ];

    protected $casts = ['status' => 'boolean'];

    public function getImageUrlAttribute(): string
    {
        return asset('uploads/sliders/' . $this->image);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true)->orderBy('sort_order');
    }
}
