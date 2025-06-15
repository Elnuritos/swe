<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Sneaker\SneakerOrder;
use Illuminate\Support\Facades\Auth;
use App\Actions\SneakerOrder\CancelOrderAction;
use App\Http\Resources\SneakerOrder\OrderResource;
use App\Services\SneakerOrder\SneakerOrderService;
use App\Http\Requests\SneakerOrder\PlaceOrderRequest;

class OrderController extends Controller
{
    public function __construct(
        protected SneakerOrderService $svc,
        protected CancelOrderAction  $cancelOrder,
    ) {}
    public function checkout(PlaceOrderRequest $req): JsonResponse
    {
        $order = $this->svc->checkout($req->validated(), Auth::guard('sanctum')->user());
        return response()->json(new OrderResource($order), 201);
    }

    public function index(): JsonResponse
    {
        $orders = $this->svc->list(Auth::guard('sanctum')->user());
        return response()->json(OrderResource::collection($orders));
    }


    public function show(SneakerOrder $order): JsonResponse
    {
        abort_unless($order->sneaker_user_id === Auth::guard('sanctum')->user()->id, 403);
        $order = $this->svc->show($order);
        return response()->json(new OrderResource($order));
    }
    public function cancel(SneakerOrder $order): JsonResponse
    {

        if ($order->sneaker_user_id !== Auth::guard('sanctum')->user()->id) {
            abort(403, 'You can only cancel your own orders');
        }
        $order = ($this->cancelOrder)($order);
        return response()->json(new OrderResource($order));
    }
}
