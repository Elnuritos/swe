<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;
use App\Models\Sneaker\SneakerProduct;
use App\Services\SneakerProduct\SneakerProductService;
use App\Http\Resources\SneakerProduct\SneakerProductResource;
use App\Http\Requests\SneakerProduct\StoreSneakerProductRequest;
use App\Http\Requests\SneakerProduct\UpdateSneakerProductRequest;

class SneakerProductController extends Controller
{
    public function __construct(
        protected SneakerProductService $service
    ) {}

    public function index(): JsonResponse
    {
        $products = $this->service->list();
        return response()->json(SneakerProductResource::collection($products));
    }

    public function store(StoreSneakerProductRequest $request): JsonResponse
    {

        $product = $this->service->create($request->validated());
        return response()->json(new SneakerProductResource($product), 201);
    }

    public function update(UpdateSneakerProductRequest $request, SneakerProduct $product): JsonResponse
    {

        $updated = $this->service->update($product, $request->validated());
        return response()->json(new SneakerProductResource($updated));
    }
    public function show(SneakerProduct $product): JsonResponse
    {
        $product = $this->service->show($product);
        return response()->json(new SneakerProductResource($product));
    }


    public function destroy(SneakerProduct $product): JsonResponse
    {
        $this->service->delete($product);
        return response()->json(['message' => 'Deleted successfully']);
    }
}
