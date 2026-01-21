<?php

namespace App\Services;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Collection;

class ShopService
{
    public function getActiveShops(): Collection
    {
        return Shop::where("is_active", true)->orderBy("city")->get();
    }

    public function createShop(array $data): Shop
    {
        return Shop::create($data);
    }

    public function findById(int $id): Shop
    {
        return Shop::findOrFail($id);
    }

    public function deleteShop(int $id): bool
    {
        $shop = $this->findById($id);
        return $shop->delete();
    }
}
