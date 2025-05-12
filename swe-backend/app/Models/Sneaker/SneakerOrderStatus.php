<?php

namespace App\Models\Sneaker;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SneakerOrderStatus extends Model
{
    use HasFactory;

    protected $table = 'sneaker_order_statuses';

    protected $fillable = [
        'name',
    ];

    public function orders()
    {
        return $this->hasMany(SneakerOrder::class, 'sneaker_order_status_id');
    }
}
