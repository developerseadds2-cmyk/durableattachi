<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MegamenuBanner extends Model
{
    protected $fillable = ['megamenu_id', 'image', 'title', 'subtitle', 'link'];

    public function megamenu()
    {
        return $this->belongsTo(Megamenu::class);
    }

    public function getImageUrlAttribute(): string
    {
        return asset('uploads/megamenu/' . $this->image);
    }
}
