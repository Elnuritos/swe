<?php

namespace App\Http\Resources\SneakerOrder;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SneakerOrder\OrderItemResource;
use App\Http\Resources\SneakerAddress\SneakerAddressResource;

class OrderResource extends JsonResource
{
    public function toArray($req): array
    {
        return [
          'id'      => $this->id,
          'status'  => $this->status->name,
          'total'   => $this->total,
          'address' => new SneakerAddressResource($this->address),
          'items'   => OrderItemResource::collection($this->items),
          'email'   => $this->payment_email,
        ];
    }

}
