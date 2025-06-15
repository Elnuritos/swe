<?php

namespace App\Http\Requests\SneakerOrder;

use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'country'     => ['required', 'string', 'max:255'],
            'city'        => ['required', 'string', 'max:255'],
            'street'      => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:20'],
            'phone'       => ['nullable', 'string', 'max:20'],
            'payment_email' => ['required', 'email'],
        ];
    }
}
