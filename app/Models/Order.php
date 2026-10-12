<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'recipient_name',
        'phone',
        'shipping_address',
        'total_amount',
        'payment_method',
        'status',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
        ];
    }

    // Người dùng đặt đơn hàng
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Một đơn hàng có nhiều chi tiết sách
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}