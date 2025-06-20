<?php

namespace App\Http\Resources\SneakerCart;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SneakerProduct\SneakerProductResource;

class CartItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'       => $this->id,
            'product'  => new SneakerProductResource($this->product),
            'quantity' => $this->quantity,
              'size'       => $this->size,
        ];
    }
}
