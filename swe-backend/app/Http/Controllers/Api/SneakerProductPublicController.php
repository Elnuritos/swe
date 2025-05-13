<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

use App\Filters\SneakerProductFilters;
use App\Models\Sneaker\SneakerProduct;
use App\Http\Resources\SneakerProduct\SneakerProductResource;
use App\Http\Requests\SneakerProduct\SneakerProductListRequest;

class SneakerProductPublicController extends Controller
{
    public function index(SneakerProductListRequest $request): JsonResponse
    {
        $query = SneakerProduct::with(['categories', 'images']);
        $filters = new SneakerProductFilters($request);
        $filtered = $filters->apply($query);

        $perPage = $request->get('per_page', 15);
        $products = $filtered->paginate($perPage);

        return response()->json(SneakerProductResource::collection($products));
    }
    public function show(int $id): JsonResponse
    {
        $product = SneakerProduct::with(['categories', 'images'])->findOrFail($id);
        return response()->json(new SneakerProductResource($product));
    }

}
