<?php

use App\Http\Controllers\Api\Admin\SneakerCategoryController;
use App\Http\Controllers\Api\Admin\SneakerProductController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\SneakerCategoryPublicController;
use App\Http\Controllers\Api\SneakerProductPublicController;
use Illuminate\Support\Facades\Route;




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
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index']);
    Route::post('/', [CartController::class, 'store']);
    Route::put('{item}', [CartController::class, 'update']);
    Route::delete('{item}', [CartController::class, 'destroy']);
});

