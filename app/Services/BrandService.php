<?php

namespace App\Services;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Collection;

class BrandService
{
    public function getAllBrands(): Collection
    {
        return Brand::orderBy("name")->get();
    }

    public function createBrand(array $data): Brand
    {
        return Brand::create($data);
    }

    public function updateBrand(Brand $brand, array $data): Brand
    {
        $brand->update($data);
        return $brand;
    }

    public function deleteBrand(Brand $brand): bool
    {
        return $brand->delete();
    }
}
