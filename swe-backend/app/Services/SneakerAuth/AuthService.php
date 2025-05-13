<?php

namespace App\Services\SneakerAuth;

use App\Actions\Auth\LoginUserAction;
use App\Models\Sneaker\SneakerUser;
use App\Actions\Auth\RegisterUserAction;


class AuthService
{
    public function __construct(
        protected RegisterUserAction $registerUserAction,
        protected LoginUserAction $loginUserAction
    ) {
    }

    public function register(array $data): array
    {

        $user = ($this->registerUserAction)($data);

        $token = $user->createToken('api')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
    public function login(array $credentials): array
    {

        $user = ($this->loginUserAction)($credentials);

        $token = $user->createToken('api')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function logout(SneakerUser $user): void
    {
        $user->currentAccessToken()->delete();
    }
}
