<?php

namespace App\Models\Sneaker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SneakerProductImage extends Model
{
    use HasFactory;

    protected $table = 'sneaker_product_images';

    protected $fillable = [
        'sneaker_product_id',
        'url',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(SneakerProduct::class, 'sneaker_product_id');
    }
}
