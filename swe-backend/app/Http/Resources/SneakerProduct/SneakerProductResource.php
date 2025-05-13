<?php

namespace App\Http\Resources\SneakerProduct;

use Illuminate\Http\Resources\Json\JsonResource;

class SneakerProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'color' => $this->color,
            'size' => $this->size,
            'stock' => $this->stock,
            'categories' => $this->categories->pluck('name'),
            'image' => $this->images()->where('is_primary', true)->first()?->url,
        ];
    }
}
