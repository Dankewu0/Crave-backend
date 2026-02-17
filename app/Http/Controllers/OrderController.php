<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService) {}

    public function index(): JsonResponse
    {
        $orders = $this->orderService->getUserOrders(Auth::id());
        return response()->json($orders);
    }

    public function store(OrderRequest $request): JsonResponse
    {
        $order = $this->orderService->createOrder($request->validated());
        return response()->json($order, 201);
    }

    public function show(Order $order): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (
            Auth::id() !== $order->user_id &&
            !$user->hasAnyRole(["admin", "owner"])
        ) {
            return response()->json(["message" => "Forbidden"], 403);
        }

        return response()->json($order->load("products"));
    }

    public function update(OrderRequest $request, Order $order): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->hasAnyRole(["admin", "owner", "moderator"])) {
            return response()->json(["message" => "Forbidden"], 403);
        }

        $updatedOrder = $this->orderService->updateStatus(
            $order,
            $request->status,
        );
        return response()->json($updatedOrder);
    }
}
