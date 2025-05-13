<?php

namespace App\Services\SneakerProduct;

use App\Actions\SneakerProduct\CreateSneakerProductAction;
use App\Actions\SneakerProduct\UpdateSneakerProductAction;
use App\Actions\SneakerProduct\DeleteSneakerProductAction;
use App\Actions\SneakerProduct\ListSneakerProductsAction;
use App\Models\Sneaker\SneakerProduct;

class SneakerProductService
{
    public function __construct(
        protected CreateSneakerProductAction $create,
        protected UpdateSneakerProductAction $update,
        protected DeleteSneakerProductAction $delete,
        protected ListSneakerProductsAction $list,
    ) {}

    public function list()
    {
        return ($this->list)();
    }

    public function create(array $data): SneakerProduct
    {
        return ($this->create)($data);
    }

    public function update(SneakerProduct $product, array $data): SneakerProduct
    {
        return ($this->update)($product, $data);
    }

    public function delete(SneakerProduct $product): void
    {
        ($this->delete)($product);
    }
}
