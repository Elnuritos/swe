<?php

namespace App\Actions\Auth;

use App\Models\Sneaker\SneakerUser;
use Illuminate\Support\Facades\Hash;

class RegisterUserAction
{
    public function __invoke(array $data): SneakerUser
    {
        return SneakerUser::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);
    }
}
