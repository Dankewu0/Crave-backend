<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService
{
    public function getPaginatedProducts(
        int $perPage = 15,
    ): LengthAwarePaginator {
        return Product::with(["category", "images"])
            ->where("quantity", ">", 0)
            ->latest()
            ->paginate($perPage);
    }

    public function createProduct(array $data): Product
    {
        $data["slug"] = Str::slug($data["name"]);
        return Product::create($data);
    }

    public function updateProduct(Product $product, array $data): Product
    {
        if (isset($data["name"])) {
            $data["slug"] = Str::slug($data["name"]);
        }
        $product->update($data);
        return $product;
    }

    public function deleteProduct(Product $product): bool
    {
        return $product->delete();
    }
}
