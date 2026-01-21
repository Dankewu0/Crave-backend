<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function __construct(protected CartService $cartService) {}

    public function index(): JsonResponse
    {
        return response()->json($this->cartService->getCart());
    }

    public function store(CartRequest $request): JsonResponse
    {
        $item = $this->cartService->addItem($request->validated());
        return response()->json($item, 201);
    }

    public function update(CartRequest $request, int $itemId): JsonResponse
    {
        $item = $this->cartService->updateQuantity($itemId, $request->quantity);
        return response()->json($item);
    }

    public function destroy(int $itemId): JsonResponse
    {
        $this->cartService->removeItem($itemId);
        return response()->json(null, 204);
    }
}
