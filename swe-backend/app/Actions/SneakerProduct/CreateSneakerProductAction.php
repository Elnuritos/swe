<?php

namespace App\Actions\SneakerProduct;

use App\Models\Sneaker\SneakerProduct;
use App\Models\Sneaker\SneakerProductImage;
use Illuminate\Support\Facades\Storage;

class CreateSneakerProductAction
{
    public function __invoke(array $data): SneakerProduct
    {
        $image = $data['image'] ?? null;
        $categoryIds = $data['category_ids'] ?? [];

        unset($data['image'], $data['category_ids']);
        $product = SneakerProduct::create($data);


        if ($image) {
            $path = $image->store('sneakers', 'public');

            SneakerProductImage::create([
                'sneaker_product_id' => $product->id,
                'url' => Storage::url($path),
                'is_primary' => true,
            ]);
        }

        $product->categories()->sync($categoryIds);

        return $product;
    }
}
