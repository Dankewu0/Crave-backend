<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function getCart()
    {
        return Cart::firstOrCreate(["user_id" => Auth::id()])->load(
            "items.product",
        );
    }

    public function addItem(array $data): CartItem
    {
        $cart = Cart::firstOrCreate(["user_id" => Auth::id()]);

        $item = $cart
            ->items()
            ->where("product_id", $data["product_id"])
            ->first();

        if ($item) {
            $item->increment("quantity", $data["quantity"] ?? 1);
            return $item;
        }

        return $cart->items()->create([
            "product_id" => $data["product_id"],
            "quantity" => $data["quantity"] ?? 1,
        ]);
    }

    public function updateQuantity(int $itemId, int $quantity): CartItem
    {
        $item = CartItem::whereHas("cart", function ($query) {
            $query->where("user_id", Auth::id());
        })->findOrFail($itemId);

        $item->update(["quantity" => $quantity]);
        return $item;
    }

    public function removeItem(int $itemId): bool
    {
        $item = CartItem::whereHas("cart", function ($query) {
            $query->where("user_id", Auth::id());
        })->findOrFail($itemId);

        return $item->delete();
    }
}
