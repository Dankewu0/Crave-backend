<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            "user_id" => "required|exists:users,id",
            "status" => "required|string|max:255",
            "total_price" => "required|numeric|min:0",
            "address" => "required|string|max:255",
            "phone" => "required|string|max:255",
            "email" => "required|email|max:255",
            "payment_method" => "required|string|max:255",

            // для pivot (order_product) отдельный блок
            "products" => "required|array",
            "products.*.product_id" => "required|exists:products,id",
            "products.*.quantity" => "required|integer|min:1",
        ];
    }
}
