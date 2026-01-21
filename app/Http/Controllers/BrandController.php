<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Http\JsonResponse;

class BrandController extends Controller
{
    public function __construct(protected BrandService $brandService) {}

    public function index(): JsonResponse
    {
        return response()->json($this->brandService->getAllBrands());
    }

    public function store(BrandRequest $request): JsonResponse
    {
        $brand = $this->brandService->createBrand($request->validated());
        return response()->json($brand, 201);
    }

    public function show(Brand $brand): JsonResponse
    {
        return response()->json($brand->load("products"));
    }

    public function update(BrandRequest $request, Brand $brand): JsonResponse
    {
        $updatedBrand = $this->brandService->updateBrand(
            $brand,
            $request->validated(),
        );
        return response()->json($updatedBrand);
    }

    public function destroy(Brand $brand): JsonResponse
    {
        $this->brandService->deleteBrand($brand);
        return response()->json(null, 204);
    }
}
