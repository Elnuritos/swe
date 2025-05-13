<?php

namespace App\Actions\SneakerCategory;

use App\Models\Sneaker\SneakerCategory;
use Illuminate\Database\Eloquent\Collection;

class ListSneakerCategoriesAction
{
    public function __invoke(): Collection
    {
        return SneakerCategory::all();
    }
}
