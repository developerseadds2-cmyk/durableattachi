<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'logo', 'description', 'status'];

    protected $casts = ['status' => 'boolean'];

    protected static function boot()
    {
        parent::boot();
        static::creating(fn($m) => $m->slug = $m->slug ?: Str::slug($m->name));
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getLogoUrlAttribute(): ?string
    {
        if (!$this->logo) {
            // Check if file exists in public/images/brands/
            foreach (['svg', 'png', 'webp', 'jpg', 'avif'] as $ext) {
                if (file_exists(public_path('images/brands/' . $this->slug . '.' . $ext))) {
                    return asset('images/brands/' . $this->slug . '.' . $ext);
                }
            }
            return null;
        }

        if (Str::startsWith($this->logo, ['http://', 'https://'])) {
            return $this->logo;
        }

        if (file_exists(public_path('uploads/brands/' . $this->logo))) {
            return asset('uploads/brands/' . $this->logo);
        }

        if (file_exists(public_path($this->logo))) {
            return asset($this->logo);
        }

        return asset('uploads/' . $this->logo);
    }
}
