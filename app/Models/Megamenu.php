<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Megamenu extends Model
{
    protected $fillable = [
        'title', 'type', 'url', 'target', 'icon', 'badge_text', 'badge_color', 'parent_id', 'sort_order', 'status',
    ];

    protected $casts = ['status' => 'boolean'];

    public function columns()
    {
        return $this->hasMany(MegamenuColumn::class)->orderBy('sort_order');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('sort_order');
    }

    public function banner()
    {
        return $this->hasOne(MegamenuBanner::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true)->orderBy('sort_order');
    }
}
