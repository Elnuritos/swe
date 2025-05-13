<?php

namespace App\Actions\SneakerCategory;

use App\Models\Sneaker\SneakerCategory;

class CreateSneakerCategoryAction
{
    public function __invoke(array $data): SneakerCategory
    {
        return SneakerCategory::create($data);
    }
}
