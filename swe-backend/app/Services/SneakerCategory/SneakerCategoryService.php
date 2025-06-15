<?php

namespace App\Services\SneakerCategory;

use App\Actions\SneakerCategory\ListSneakerCategoriesAction;
use App\Models\Sneaker\SneakerCategory;
use App\Actions\SneakerCategory\CreateSneakerCategoryAction;
use App\Actions\SneakerCategory\UpdateSneakerCategoryAction;
use App\Actions\SneakerCategory\DeleteSneakerCategoryAction;

class SneakerCategoryService
{
    public function __construct(
        protected ListSneakerCategoriesAction $list,
        protected CreateSneakerCategoryAction $create,
        protected UpdateSneakerCategoryAction $update,
        protected DeleteSneakerCategoryAction $delete
    ) {
    }

    public function list()
    {
        return ($this->list)();
    }

    public function show(SneakerCategory $category): SneakerCategory
    {
        return $category;
    }

    public function create(array $data)
    {
        return ($this->create)($data);
    }

    public function update(SneakerCategory $category, array $data)
    {
        return ($this->update)($category, $data);
    }

    public function delete(SneakerCategory $category): void
    {
        ($this->delete)($category);
    }
}
