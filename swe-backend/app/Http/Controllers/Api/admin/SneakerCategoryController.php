<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Sneaker\SneakerCategory;
use App\Services\SneakerCategory\SneakerCategoryService;
use App\Http\Resources\SneakerCategory\SneakerCategoryResource;
use App\Http\Requests\SneakerCategory\StoreSneakerCategoryRequest;
use App\Http\Requests\SneakerCategory\UpdateSneakerCategoryRequest;


class SneakerCategoryController extends Controller
{
    public function __construct(
        protected SneakerCategoryService $service
    ) {}

    public function index(): JsonResponse
    {
        $categories = $this->service->list();
        return response()->json(SneakerCategoryResource::collection($categories));
    }

    public function show(SneakerCategory $category): JsonResponse
    {
        $category = $this->service->show($category);
        return response()->json(new SneakerCategoryResource($category));
    }

    public function store(StoreSneakerCategoryRequest $request): JsonResponse
    {
        $category = $this->service->create($request->validated());
        return response()->json(new SneakerCategoryResource($category), 201);
    }

    public function update(UpdateSneakerCategoryRequest $request, SneakerCategory $category): JsonResponse
    {
        $updated = $this->service->update($category, $request->validated());
        return response()->json(new SneakerCategoryResource($updated));
    }

    public function destroy(SneakerCategory $category): JsonResponse
    {
        $this->service->delete($category);
        return response()->json(['message' => 'Deleted']);
    }
}
