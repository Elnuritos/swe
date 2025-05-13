<?php

namespace App\Http\Requests\SneakerCategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSneakerCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:sneaker_categories,name,' . $this->route('category')->id],
        ];
    }
}
