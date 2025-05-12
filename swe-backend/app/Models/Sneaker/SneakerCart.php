<?php

namespace App\Models\Sneaker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SneakerCart extends Model
{
    use HasFactory;

    protected $table = 'sneaker_carts';

    protected $fillable = [
        'sneaker_user_id',
        'session_token',
    ];

    public function user()
    {
        return $this->belongsTo(SneakerUser::class, 'sneaker_user_id');
    }

    public function items()
    {
        return $this->hasMany(SneakerCartItem::class, 'sneaker_cart_id');
    }
}
