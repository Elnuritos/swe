<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sneaker\SneakerUser;
use Illuminate\Support\Facades\Hash;

class SneakerUserSeeder extends Seeder
{
    public function run(): void
    {
        SneakerUser::firstOrCreate([
            'email' => 'user@example.com',
        ], [
            'name' => 'Test User',
            'password' => Hash::make('password'),
        ]);


        SneakerUser::factory(5)->create();
    }
}
