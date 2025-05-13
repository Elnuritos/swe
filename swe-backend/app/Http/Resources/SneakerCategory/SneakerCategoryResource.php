<?php

namespace App\Http\Resources\SneakerCategory;

use Illuminate\Http\Resources\Json\JsonResource;

class SneakerCategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'   => $this->id,
            'name' => $this->name,
        ];
    }
}
