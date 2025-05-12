<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sneaker\SneakerCategory;

class SneakerCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Men', 'Women', 'Children', 'Sports', 'Classic'];

        foreach ($categories as $name) {
            SneakerCategory::firstOrCreate(['name' => $name]);
        }
    }
}
