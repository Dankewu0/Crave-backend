<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ShopRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var User $user */
        $user = Auth::user();

        return Auth::check() && $user->hasAnyRole(["admin", "owner"]);
    }

    public function rules(): array
    {
        return [
            "name" => "required|string|max:255",
            "city" => "required|string|max:100",
            "address" => "required|string|max:500",
            "phone" => "required|string|max:20",
            "work_time" => "nullable|string|max:255",
            "is_active" => "sometimes|boolean",
        ];
    }
}
