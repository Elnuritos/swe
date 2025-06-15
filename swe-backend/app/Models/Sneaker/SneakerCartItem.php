<?php

namespace App\Models\Sneaker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SneakerCartItem extends Model
{
    use HasFactory;

    protected $table = 'sneaker_cart_items';

    protected $fillable = [
        'sneaker_cart_id',
        'sneaker_product_id',
        'quantity',
        'size',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'size'     => 'array',
    ];

    public function cart()
    {
        return $this->belongsTo(SneakerCart::class, 'sneaker_cart_id');
    }

    public function product()
    {
        return $this->belongsTo(SneakerProduct::class, 'sneaker_product_id');
    }
}
