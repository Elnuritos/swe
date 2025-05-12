<?php

namespace App\Models\Sneaker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SneakerAddress extends Model
{
    use HasFactory;

    protected $table = 'sneaker_addresses';

    protected $fillable = [
        'sneaker_user_id',
        'country',
        'city',
        'street',
        'postal_code',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(SneakerUser::class, 'sneaker_user_id');
    }
}
