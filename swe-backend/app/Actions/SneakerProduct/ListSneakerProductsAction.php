<?php

namespace App\Actions\SneakerProduct;

use App\Models\Sneaker\SneakerProduct;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListSneakerProductsAction
{
    public function __invoke(): LengthAwarePaginator
    {
        return SneakerProduct::with(['categories', 'images'])->paginate(15);
    }
}
