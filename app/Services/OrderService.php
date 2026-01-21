<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function createOrder(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $product = Product::findOrFail($data["product_id"]);

            $order = Order::create([
                "user_id" => $data["user_id"],
                "status" => $data["status"],
                "total_price" => $product->price * $data["quantity"],
                "address" => $data["address"],
                "phone" => $data["phone"],
                "email" => $data["email"],
                "payment_method" => $data["payment_method"],
            ]);

            $order->products()->attach($product->id, [
                "quantity" => $data["quantity"],
                "price" => $product->price,
            ]);

            $product->decrement("quantity", $data["quantity"]);

            return $order;
        });
    }

    public function getUserOrders(int $userId)
    {
        return Order::where("user_id", $userId)
            ->with("products")
            ->latest()
            ->get();
    }

    public function updateStatus(Order $order, string $status): Order
    {
        $order->update(["status" => $status]);
        return $order;
    }
}
