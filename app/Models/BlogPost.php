<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug', 'excerpt', 'body',
        'thumbnail', 'is_featured', 'status', 'published_at', 'meta_title', 'meta_description', 'views',
    ];

    protected $casts = [
        'is_featured'  => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(fn($m) => $m->slug = $m->slug ?: Str::slug($m->title));
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) return asset('uploads/blog/' . $this->thumbnail);
        return asset('images/blog-placeholder.jpg');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function getReadingTimeAttribute(): int
    {
        $words = str_word_count(strip_tags($this->body ?? ''));
        return (int) ceil($words / 200);
    }
}
