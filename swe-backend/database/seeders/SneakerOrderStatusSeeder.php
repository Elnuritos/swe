<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sneaker\SneakerOrderStatus;

class SneakerOrderStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'];

        foreach ($statuses as $status) {
            SneakerOrderStatus::firstOrCreate(['name' => $status]);
        }
    }
}
