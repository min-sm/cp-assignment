<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'payment_method',
        'kbzpay_number',
        'status',
    ];

    // An order belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // An order has many order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
