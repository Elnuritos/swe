<?php

namespace App\Http\Resources\SneakerOrder;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SneakerProduct\SneakerProductResource;

class OrderItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'       => $this->id,
            'product'  => new SneakerProductResource($this->product),
            'quantity' => $this->quantity,
            'price'    => $this->price,
        ];
    }
}
