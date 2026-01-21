<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return Auth::check() && $user->hasAnyRole(["admin", "owner"]);
    }

    public function rules(): array
    {
        return [
            "name" => "required|string|max:255",
            "slug" =>
                "nullable|string|max:255|unique:categories,slug," .
                ($this->category?->id ?? "NULL"),
        ];
    }
}
