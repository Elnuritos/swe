<?php
namespace App\Models\Sneaker;

use App\Models\Sneaker\SneakerAddress;
use App\Models\Sneaker\SneakerCart;
use App\Models\Sneaker\SneakerOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class SneakerUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'sneaker_users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function addresses()
    {
        return $this->hasMany(SneakerAddress::class, 'sneaker_user_id');
    }

    public function orders()
    {
        return $this->hasMany(SneakerOrder::class, 'sneaker_user_id');
    }

    public function cart()
    {
        return $this->hasOne(SneakerCart::class, 'sneaker_user_id');
    }
}
