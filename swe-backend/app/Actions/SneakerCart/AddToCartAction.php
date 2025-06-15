<?php

namespace App\Actions\SneakerCart;

use App\Models\Sneaker\SneakerCart;
use App\Models\Sneaker\SneakerCartItem;

class AddToCartAction
{
    public function __invoke(SneakerCart $cart, int $productId,int $qty, array $size): SneakerCartItem
    {
        $item = $cart->items()
                     ->where('sneaker_product_id', $productId)
                     ->whereJsonContains('size', $size)
                     ->first();

        if ($item) {

            $item->increment('quantity', $qty);
            return $item->refresh();
        }


        return $cart->items()->create([
            'sneaker_product_id' => $productId,
            'quantity'           => $qty,
            'size'     => $size,
        ]);
    }
}
