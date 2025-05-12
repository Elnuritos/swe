<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sneaker\SneakerProduct;
use App\Models\Sneaker\SneakerCategory;
use App\Models\Sneaker\SneakerProductImage;

class SneakerProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = SneakerCategory::all();

        foreach (range(1, 20) as $i) {
            $product = SneakerProduct::create([
                'name' => "Sneaker Model #$i",
                'description' => 'High-quality sneaker with comfort fit and modern design.',
                'price' => rand(50, 200),
                'color' => fake()->safeColorName(),
                'size' => fake()->randomElement(['38', '39', '40', '41', '42', '43', '44']),
                'stock' => rand(0, 100),
            ]);

            $category = $categories->random();
            $product->categories()->attach($category);

            SneakerProductImage::create([
                'sneaker_product_id' => $product->id,
                'url' => 'https://fakeimg.pl/600x400',
                'is_primary' => true,
            ]);
        }
    }
}
