<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var User $user */
        $user = Auth::user();
        $targetUser = $this->route("user");

        if (!$user) {
            return false;
        }

        if ($targetUser && $user->id === $targetUser->id) {
            return true;
        }

        return $user->hasAnyRole(["admin", "owner", "moderator"]);
    }

    public function rules(): array
    {
        $userId = $this->route("user")?->id ?? Auth::id();

        return [
            "name" => "sometimes|string|max:255",
            "email" => "sometimes|email|unique:users,email," . $userId,
            "avatar" => "nullable|image|mimes:jpg,jpeg,png|max:2048",
            "tag" => "sometimes|string|max:50|unique:users,tag," . $userId,
            "password" => "sometimes|nullable|string|min:8|confirmed",
        ];
    }
}
