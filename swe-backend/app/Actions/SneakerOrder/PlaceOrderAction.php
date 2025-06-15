<?php

namespace App\Actions\SneakerOrder;

use Illuminate\Http\Request;
use App\Mail\OrderInvoiceMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Sneaker\SneakerOrder;
use Illuminate\Support\Facades\Mail;
use App\Models\Sneaker\SneakerAddress;
use App\Models\Sneaker\SneakerOrderItem;
use App\Services\SneakerCart\CartService;



class PlaceOrderAction
{
    public function __construct(
        protected CartService $cartService,
        protected Request     $request

    ) {}

    /**
     * @param  array
     * @param  \App\Models\Sneaker\SneakerUser  $user
     * @return SneakerOrder
     */
    public function __invoke(array $data, $user): SneakerOrder
    {

        $cart = $this->cartService->getOrCreateCart($this->request);

        return DB::transaction(function () use ($data, $user, $cart) {

            $address = SneakerAddress::create([
                'sneaker_user_id' => $user->id,
                'country'         => $data['country'],
                'city'            => $data['city'],
                'street'          => $data['street'],
                'postal_code'     => $data['postal_code'],
                'phone'           => $data['phone'] ?? null,
            ]);


            $order = SneakerOrder::create([
                'sneaker_user_id'     => $user->id,
                'sneaker_address_id'  => $address->id,
                'payment_email'       => $data['payment_email'],
                'sneaker_order_status_id' => 1, // pending
                'total'               => 0,
            ]);

            $total = 0;

            foreach ($cart->items as $item) {
                SneakerOrderItem::create([
                    'sneaker_order_id'   => $order->id,
                    'sneaker_product_id' => $item->sneaker_product_id,
                    'quantity'           => $item->quantity,
                    'price'              => $item->product->price,
                ]);
                $total += $item->quantity * $item->product->price;
            }

            $order->update(['total' => $total]);


            $cart->items()->delete();

            try {
                Mail::to($order->payment_email)
                    ->send(new OrderInvoiceMail($order));

                Log::info("Order invoice email sent", [
                    'order_id' => $order->id,
                    'to'       => $order->payment_email,
                ]);
            } catch (\Exception $e) {
                Log::error("Failed to send order invoice email", [
                    'order_id' => $order->id,
                    'to'       => $order->payment_email,
                    'error'    => $e->getMessage(),
                ]);
                throw $e;
            }
            return $order;
        });
    }
}
