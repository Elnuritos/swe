<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Sneaker\SneakerCartItem;
use App\Services\SneakerCart\CartService;
use App\Actions\SneakerCart\GetCartAction;
use App\Actions\SneakerCart\AddToCartAction;
use App\Http\Requests\Cart\AddToCartRequest;
use App\Actions\SneakerCart\RemoveFromCartAction;
use App\Actions\SneakerCart\UpdateCartItemAction;
use App\Http\Resources\SneakerCart\CartItemResource;
use App\Http\Requests\SneakerCart\UpdateCartItemRequest;

class CartController extends Controller
{
    public function __construct(
        protected CartService $cartService,
        protected AddToCartAction $addToCart,
        protected GetCartAction $getCart,
        protected UpdateCartItemAction $updateCart,
        protected RemoveFromCartAction $removeFromCart,
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        $cart = $this->cartService->getOrCreateCart($request);
        $data = ($this->getCart)($cart);

        return response()->json([
            'items' => CartItemResource::collection($data->items),
        ]);
    }

    public function store(AddToCartRequest $request): JsonResponse
    {
        $cart = $this->cartService->getOrCreateCart($request);

        $item = ($this->addToCart)(
            $cart,
            $request->validated()['product_id'],
            $request->validated()['quantity']
        );

        return response()->json(new CartItemResource($item), 201);
    }

    public function update(UpdateCartItemRequest $request, SneakerCartItem $item): JsonResponse
    {
        $updated = ($this->updateCart)($item, $request->validated()['quantity']);
        return response()->json(new CartItemResource($updated));
    }

    public function destroy(SneakerCartItem $item): JsonResponse
    {
        ($this->removeFromCart)($item);
        return response()->json(['message' => 'Item removed']);
    }

}
