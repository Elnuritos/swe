<?php

namespace App\Http\Requests\SneakerProduct;

use Illuminate\Foundation\Http\FormRequest;

class SneakerProductListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search'       => ['nullable', 'string'],
            'category_id'  => ['nullable', 'integer', 'exists:sneaker_categories,id'],
            'color'        => ['nullable', 'string'],
            'size'         => ['nullable', 'array'],
            'min_price'    => ['nullable', 'numeric'],
            'max_price'    => ['nullable', 'numeric'],
            'per_page'     => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }
}
