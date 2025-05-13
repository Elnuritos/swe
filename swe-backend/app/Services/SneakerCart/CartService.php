<?php

namespace App\Services\SneakerCart;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Sneaker\SneakerCart;

class CartService
{
    public function getOrCreateCart(Request $request): SneakerCart
    {
        if ($request->user()) {
            return SneakerCart::firstOrCreate([
                'sneaker_user_id' => $request->user()->id,
            ]);
        }

        $token = $request->header('X-Session-Token') ?? $request->cookie('session_token');

        if (!$token) {
            $token = Str::uuid()->toString();
            $request->headers->set('X-Session-Token', $token);
        }

        return SneakerCart::firstOrCreate([
            'session_token' => $token,
        ]);
    }
}
