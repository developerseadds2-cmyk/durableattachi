<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'order_number', 'status', 'payment_status', 'payment_method',
        'subtotal', 'discount_amount', 'coupon_code', 'shipping_amount', 'tax_amount', 'total_amount',
        'billing_first_name', 'billing_last_name', 'billing_email', 'billing_phone',
        'billing_address', 'billing_city', 'billing_state', 'billing_postal_code', 'billing_country',
        'shipping_first_name', 'shipping_last_name', 'shipping_address', 'shipping_city',
        'shipping_state', 'shipping_postal_code', 'shipping_country',
        'tracking_number', 'notes', 'shipped_at', 'delivered_at',
    ];

    protected $casts = [
        'subtotal'        => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'shipping_amount' => 'decimal:2',
        'tax_amount'      => 'decimal:2',
        'total_amount'    => 'decimal:2',
        'shipped_at'      => 'datetime',
        'delivered_at'    => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending'    => '<span class="badge bg-warning">Pending</span>',
            'processing' => '<span class="badge bg-info">Processing</span>',
            'confirmed'  => '<span class="badge bg-primary">Confirmed</span>',
            'shipped'    => '<span class="badge bg-secondary">Shipped</span>',
            'delivered'  => '<span class="badge bg-success">Delivered</span>',
            'cancelled'  => '<span class="badge bg-danger">Cancelled</span>',
            'refunded'   => '<span class="badge bg-dark">Refunded</span>',
            default      => '<span class="badge bg-light text-dark">' . ucfirst($this->status) . '</span>',
        };
    }

    public function getPaymentStatusBadgeAttribute(): string
    {
        return match($this->payment_status) {
            'pending'  => '<span class="badge bg-warning">Pending</span>',
            'paid'     => '<span class="badge bg-success">Paid</span>',
            'failed'   => '<span class="badge bg-danger">Failed</span>',
            'refunded' => '<span class="badge bg-dark">Refunded</span>',
            default    => '<span class="badge bg-light text-dark">' . ucfirst($this->payment_status) . '</span>',
        };
    }

    public static function generateOrderNumber(): string
    {
        return 'GLA-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));
    }
}
