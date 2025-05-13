<?php

namespace App\Actions\SneakerCart;

use App\Models\Sneaker\SneakerCart;
use App\Models\Sneaker\SneakerCartItem;

class AddToCartAction
{
    public function __invoke(SneakerCart $cart, int $productId, int $quantity): SneakerCartItem
    {
        $item = SneakerCartItem::firstOrNew([
            'sneaker_cart_id' => $cart->id,
            'sneaker_product_id' => $productId,
        ]);

        $item->quantity += $quantity;
        $item->save();

        return $item;
    }
}
