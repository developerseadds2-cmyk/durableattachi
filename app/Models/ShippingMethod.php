<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    protected $fillable = ['name', 'description', 'price', 'free_above', 'estimated_days', 'status'];

    protected $casts = [
        'price'       => 'decimal:2',
        'free_above'  => 'decimal:2',
        'status'      => 'boolean',
    ];

    public function getActualPriceAttribute(float $orderAmount = 0): float
    {
        if ($this->free_above && $orderAmount >= $this->free_above) {
            return 0;
        }
        return $this->price;
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
