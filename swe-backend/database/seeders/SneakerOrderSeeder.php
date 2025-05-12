<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sneaker\SneakerOrder;
use App\Models\Sneaker\SneakerOrderItem;
use App\Models\Sneaker\SneakerUser;
use App\Models\Sneaker\SneakerProduct;
use App\Models\Sneaker\SneakerOrderStatus;

class SneakerOrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = SneakerUser::all();
        $products = SneakerProduct::all();
        $statuses = SneakerOrderStatus::pluck('id')->toArray();

        foreach ($users as $user) {
            $order = SneakerOrder::create([
                'sneaker_user_id' => $user->id,
                'sneaker_order_status_id' => fake()->randomElement($statuses),
                'total' => 0,
            ]);

            $total = 0;

            foreach ($products->random(3) as $product) {
                $quantity = rand(1, 3);
                $price = $product->price;

                SneakerOrderItem::create([
                    'sneaker_order_id' => $order->id,
                    'sneaker_product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);

                $total += $price * $quantity;
            }

            $order->update(['total' => $total]);
        }
    }
}
