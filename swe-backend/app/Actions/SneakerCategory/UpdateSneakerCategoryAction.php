<?php

namespace App\Actions\SneakerCategory;

use App\Models\Sneaker\SneakerCategory;

class UpdateSneakerCategoryAction
{
    public function __invoke(SneakerCategory $category, array $data): SneakerCategory
    {
        $category->update($data);
        return $category;
    }
}
