<?php

namespace App\Actions\SneakerCart;

use App\Models\Sneaker\SneakerCart;

class GetCartAction
{
    public function __invoke(SneakerCart $cart)
    {
        return $cart->load(['items.product']);
    }
}
