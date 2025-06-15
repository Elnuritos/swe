<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SneakerProductFilters
{
    public function __construct(protected Request $request)
    {
    }

    public function apply(Builder $query): Builder
    {
        return $query
            ->when(
                $this->request->filled('search'),
                fn ($q) =>
                $q->where('name', 'LIKE', '%' . $this->request->search . '%')
            )
            ->when(
                $this->request->filled('category_id'),
                fn ($q) =>
                $q->whereHas(
                    'categories',
                    fn ($c) =>
                    $c->where('sneaker_categories.id', $this->request->category_id)
                )
            )
            ->when(
                $this->request->filled('color'),
                fn ($q) =>
                $q->where('color', $this->request->color)
            )
            ->when(
                $this->request->filled('size'),
                fn ($q) =>
                $q->whereJsonContains('size', $this->request->size)
            )
            ->when(
                $this->request->filled('min_price'),
                fn ($q) =>
                $q->where('price', '>=', $this->request->min_price)
            )
            ->when(
                $this->request->filled('max_price'),
                fn ($q) =>
                $q->where('price', '<=', $this->request->max_price)
            );
    }
}
