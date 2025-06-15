<?php

namespace App\Services\SneakerCart;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Sneaker\SneakerCart;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function getOrCreateCart(Request $request): SneakerCart
    {

        if (Auth::guard('sanctum')->user()) {
            return SneakerCart::firstOrCreate([
                'sneaker_user_id' => Auth::guard('sanctum')->user()->id,
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
