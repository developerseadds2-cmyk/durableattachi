<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title', 'subtitle', 'image', 'link', 'type', 'sort_order', 'status'];

    protected $casts = ['status' => 'boolean'];

    public function getImageUrlAttribute(): string
    {
        return asset('uploads/banners/' . $this->image);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true)->orderBy('sort_order');
    }
}
