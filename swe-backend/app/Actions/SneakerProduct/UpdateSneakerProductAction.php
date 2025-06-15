<?php

namespace App\Actions\SneakerProduct;

use App\Models\Sneaker\SneakerProduct;
use Illuminate\Support\Facades\Storage;

class UpdateSneakerProductAction
{
    public function __invoke(SneakerProduct $product, array $data): SneakerProduct
    {
        $image = $data['image'] ?? null;
        $categoryIds = $data['category_ids'] ?? null;

        unset($data['image'], $data['category_ids']);
        $product->update($data);

        if ($image) {
            $existing = $product->images()->where('is_primary', true)->first();
            if ($existing) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $existing->url));
                $existing->delete();
            }

            $path = $image->store('sneakers', 'public');
            $product->images()->create([
                'url' => Storage::url($path),
                'is_primary' => true,
            ]);
        }

        if (is_array($categoryIds)) {
            $product->categories()->sync($categoryIds);
        }

        return $product;
    }
}
