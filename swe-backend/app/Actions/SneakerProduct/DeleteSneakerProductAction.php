<?php

namespace App\Actions\SneakerProduct;

use App\Models\Sneaker\SneakerProduct;
use Illuminate\Support\Facades\Storage;

class DeleteSneakerProductAction
{
    public function __invoke(SneakerProduct $product): void
    {
        foreach ($product->images as $image) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $image->url));
            $image->delete();
        }

        $product->categories()->detach();
        $product->delete();
    }
}
