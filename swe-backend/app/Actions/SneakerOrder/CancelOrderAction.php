<?php

namespace App\Actions\SneakerOrder;

use App\Models\Sneaker\SneakerOrder;
use Illuminate\Validation\ValidationException;

class CancelOrderAction
{
    public function __invoke(SneakerOrder $order): SneakerOrder
    {

        if ($order->sneaker_order_status_id !== 1) {
            throw ValidationException::withMessages([
                'order' => ['Only pending orders can be cancelled.'],
            ]);
        }


        $order->update([
            'sneaker_order_status_id' => 5,
        ]);

        return $order->load(['items.product', 'address', 'status']);
    }
}
