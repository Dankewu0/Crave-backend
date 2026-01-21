<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return Auth::check() &&
            $user->hasAnyRole(["admin", "owner", "moderator"]);
    }

    public function rules(): array
    {
        return [
            "name" =>
                "required|string|max:255|unique:brands,name," .
                ($this->brand?->id ?? "NULL"),
        ];
    }
}
