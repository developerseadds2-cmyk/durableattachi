<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    protected $fillable = [
        'code', 'type', 'value', 'min_order_amount', 'max_discount_amount',
        'usage_limit', 'used_count', 'user_id', 'start_date', 'end_date', 'status',
    ];

    protected $casts = [
        'value'               => 'decimal:2',
        'min_order_amount'    => 'decimal:2',
        'max_discount_amount' => 'decimal:2',
        'start_date'          => 'date',
        'end_date'            => 'date',
        'status'              => 'boolean',
    ];

    public function isValid(float $orderAmount): bool
    {
        if (!$this->status) return false;
        if ($this->start_date && Carbon::today()->lt($this->start_date)) return false;
        if ($this->end_date && Carbon::today()->gt($this->end_date)) return false;
        if ($this->usage_limit && $this->used_count >= $this->usage_limit) return false;
        if ($orderAmount < $this->min_order_amount) return false;
        return true;
    }

    public function calculateDiscount(float $orderAmount): float
    {
        if ($this->type === 'percentage') {
            $discount = ($orderAmount * $this->value) / 100;
            if ($this->max_discount_amount) {
                $discount = min($discount, $this->max_discount_amount);
            }
            return $discount;
        }
        return min($this->value, $orderAmount);
    }
}
