<?php

namespace App\Models\Sneaker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SneakerOrderItem extends Model
{
    use HasFactory;

    protected $table = 'sneaker_order_items';

    protected $fillable = [
        'sneaker_order_id',
        'sneaker_product_id',
        'quantity',
        'price',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(SneakerOrder::class, 'sneaker_order_id');
    }

    public function product()
    {
        return $this->belongsTo(SneakerProduct::class, 'sneaker_product_id');
    }
}
