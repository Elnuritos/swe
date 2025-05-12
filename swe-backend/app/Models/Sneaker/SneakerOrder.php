<?php

namespace App\Models\Sneaker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SneakerOrder extends Model
{
    use HasFactory;

    protected $table = 'sneaker_orders';

    protected $fillable = [
        'sneaker_user_id',
        'sneaker_order_status_id',
        'total',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(SneakerUser::class, 'sneaker_user_id');
    }

    public function status()
    {
        return $this->belongsTo(SneakerOrderStatus::class, 'sneaker_order_status_id');
    }

    public function items()
    {
        return $this->hasMany(SneakerOrderItem::class, 'sneaker_order_id');
    }
}
