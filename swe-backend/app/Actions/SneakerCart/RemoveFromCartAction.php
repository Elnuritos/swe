<?php

namespace App\Actions\SneakerCart;

use App\Models\Sneaker\SneakerCartItem;

class RemoveFromCartAction
{
    public function __invoke(SneakerCartItem $item): void
    {
        $item->delete();
    }
}
