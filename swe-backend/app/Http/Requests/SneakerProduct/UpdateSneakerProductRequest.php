<?php

namespace App\Http\Requests\SneakerProduct;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSneakerProductRequest extends FormRequest
{
     /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string'],
            'description' => ['nullable', 'string'],
            'price' => ['sometimes', 'numeric'],
            'color' => ['nullable', 'string'],
            'size' => ['nullable', 'string'],
            'stock' => ['sometimes', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'],
            'category_ids' => ['sometimes', 'array'],
            'category_ids.*' => ['integer', 'exists:sneaker_categories,id'],
        ];
    }
}
