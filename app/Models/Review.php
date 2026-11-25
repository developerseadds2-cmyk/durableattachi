<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'product_id', 'user_id', 'customer_name', 'customer_email',
        'order_id', 'rating', 'title', 'body', 'status'
    ];

    public function getAuthorNameAttribute()
    {
        if ($this->user) {
            return $this->user->name;
        }
        return $this->customer_name ?: 'Verified Buyer';
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
