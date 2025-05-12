<?php

namespace App\Models\Sneaker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SneakerCategory extends Model
{
    use HasFactory;

    protected $table = 'sneaker_categories';

    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->belongsToMany(
            SneakerProduct::class,
            'sneaker_product_category',
            'sneaker_category_id',
            'sneaker_product_id'
        );
    }
}
