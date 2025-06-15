<?php

namespace App\Models\Sneaker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SneakerProduct extends Model
{
    use HasFactory;

    protected $table = 'sneaker_products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'color',
        'size',
        'stock',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'size'  => 'array',
    ];

    public function images()
    {
        return $this->hasMany(SneakerProductImage::class, 'sneaker_product_id');
    }

    public function categories()
    {
        return $this->belongsToMany(
            SneakerCategory::class,
            'sneaker_product_category',
            'sneaker_product_id',
            'sneaker_category_id'
        );
    }

    public function cartItems()
    {
        return $this->hasMany(SneakerCartItem::class, 'sneaker_product_id');
    }

    public function orderItems()
    {
        return $this->hasMany(SneakerOrderItem::class, 'sneaker_product_id');
    }
}
