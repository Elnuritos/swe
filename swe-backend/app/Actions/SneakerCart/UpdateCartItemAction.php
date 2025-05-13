<?php

namespace App\Actions\SneakerCart;

use App\Models\Sneaker\SneakerCartItem;

class UpdateCartItemAction
{
    public function __invoke(SneakerCartItem $item, int $quantity): SneakerCartItem
    {
        $item->quantity = $quantity;
        $item->save();

        return $item;
    }
}
