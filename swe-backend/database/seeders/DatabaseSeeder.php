<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SneakerCategorySeeder::class,
            SneakerProductSeeder::class,
            SneakerUserSeeder::class,
            SneakerOrderStatusSeeder::class,
            SneakerOrderSeeder::class,
        ]);
    }
}
