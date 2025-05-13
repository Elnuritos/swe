<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\SneakerProductController;
use App\Http\Controllers\Api\SneakerProductPublicController;
use App\Http\Controllers\Api\Admin\SneakerCategoryController;
use App\Http\Controllers\Api\SneakerCategoryPublicController;



Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->group(function () {
    Route::apiResource('products', SneakerProductController::class);
    Route::apiResource('categories', SneakerCategoryController::class)->only(['store', 'update', 'destroy']);
});
Route::get('/categories', [SneakerCategoryPublicController::class, 'index']);

Route::prefix('products')->group(function () {
    Route::get('/', [SneakerProductPublicController::class, 'index']);
    Route::get('{id}', [SneakerProductPublicController::class, 'show']);
});
