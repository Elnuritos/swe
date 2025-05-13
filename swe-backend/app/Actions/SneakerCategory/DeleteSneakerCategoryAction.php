<?php

namespace App\Actions\SneakerCategory;

use App\Models\Sneaker\SneakerCategory;

class DeleteSneakerCategoryAction
{
    public function __invoke(SneakerCategory $category): void
    {
        $category->delete();
    }
}
