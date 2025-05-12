<?php

namespace App\Actions\Auth;

use App\Models\Sneaker\SneakerUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginUserAction
{
    public function __invoke(array $credentials): SneakerUser
    {
        $user = SneakerUser::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        return $user;
    }
}
