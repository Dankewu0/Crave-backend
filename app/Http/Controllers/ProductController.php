<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(protected ProductService $service) {}

    public function index(): JsonResponse
    {
        return response()->json($this->service->getPaginatedProducts());
    }

    public function store(ProductRequest $request): JsonResponse
    {
        $product = $this->service->createProduct($request->validated());
        return response()->json($product, 201);
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json(
            $product->load(["category", "images", "reviews"]),
        );
    }

    public function update(
        ProductRequest $request,
        Product $product,
    ): JsonResponse {
        $updatedProduct = $this->service->updateProduct(
            $product,
            $request->validated(),
        );
        return response()->json($updatedProduct);
    }

    public function destroy(Product $product): JsonResponse
    {
        $this->authorize("manage products");
        $this->service->deleteProduct($product);
        return response()->json(null, 204);
    }
}
