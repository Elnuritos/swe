<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SneakerCategory\SneakerCategoryResource;
use App\Services\SneakerCategory\SneakerCategoryService;
use Illuminate\Http\JsonResponse;

class SneakerCategoryPublicController extends Controller
{
    public function __construct(
        protected SneakerCategoryService $service
    ) {}

    public function index(): JsonResponse
    {
        $categories = $this->service->list();

        return response()->json(SneakerCategoryResource::collection($categories));
    }
}
