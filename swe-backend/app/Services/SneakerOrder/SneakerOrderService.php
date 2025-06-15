<?php

namespace App\Services\SneakerOrder;


use App\Models\Sneaker\SneakerUser;
use App\Models\Sneaker\SneakerOrder;
use Illuminate\Database\Eloquent\Collection;
use App\Actions\SneakerOrder\PlaceOrderAction;
use App\Actions\SneakerOrder\CancelOrderAction;


class SneakerOrderService
{
    public function __construct(
        protected PlaceOrderAction  $place,
        protected CancelOrderAction $cancelOrder,
    ) {}
    public function checkout(array $data, SneakerUser $user): SneakerOrder
    {
        return ($this->place)($data, $user);
    }
    public function list($user): Collection
    {
        return SneakerOrder::with(['items.product', 'address', 'status'])
                            ->where('sneaker_user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->get();
    }
    public function show(SneakerOrder $order): SneakerOrder
    {
        return $order->load(['items.product', 'address', 'status']);
    }
    public function cancel(SneakerOrder $order): SneakerOrder
    {
        return ($this->cancelOrder)($order);
    }

}
