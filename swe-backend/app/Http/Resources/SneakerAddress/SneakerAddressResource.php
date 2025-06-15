<?php

namespace App\Http\Resources\SneakerAddress;

use Illuminate\Http\Resources\Json\JsonResource;

class SneakerAddressResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'country'     => $this->country,
            'city'        => $this->city,
            'street'      => $this->street,
            'postal_code' => $this->postal_code,
            'phone'       => $this->phone,
        ];
    }
}
