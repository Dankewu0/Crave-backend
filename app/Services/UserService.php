<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;

class UserService
{
    public function getProfile(User $user)
    {
        return $user->load(["images", "privacySetting"]);
    }

    public function searchUsers(?string $query)
    {
        return User::when($query, function ($q) use ($query) {
            $q->where(function ($sub) use ($query) {
                $sub->where("name", "LIKE", "%$query%")->orWhere(
                    "email",
                    "LIKE",
                    "%$query%",
                );
            });
        })->paginate(20);
    }

    public function fetchUserByIdentifier(string $identifier, int $authUserId)
    {
        return User::with([
            "images",
            "privacySetting",
            "chats" => function ($q) use ($authUserId) {
                $q->where("type", "private")->whereHas(
                    "users",
                    fn($q2) => $q2->where("users.id", $authUserId),
                );
            },
        ])
            ->where("tag", $identifier)
            ->firstOrFail();
    }

    public function updateProfile(User $user, array $data)
    {
        if (isset($data["avatar"])) {
            if ($user->avatar) {
                Storage::disk("public")->delete($user->avatar);
            }
            $data["avatar"] = $data["avatar"]->store("avatars", "public");
        }

        if (!empty($data["password"])) {
            $data["password"] = Hash::make($data["password"]);
        } else {
            unset($data["password"]);
        }

        $user->update($data);
        return $user->refresh();
    }

    public function resetPassword(string $token, string $password)
    {
        $record =
            DB::table("password_reset_tokens")
                ->where("token", $token)
                ->first() ??
            DB::table("password_resets")->where("token", $token)->first();

        if (!$record) {
            throw new Exception("Invalid reset token.");
        }

        $user = User::where("email", $record->email)->firstOrFail();
        $user->password = Hash::make($password);
        $user->save();

        DB::table("password_reset_tokens")
            ->where("email", $record->email)
            ->delete();
        DB::table("password_resets")->where("email", $record->email)->delete();

        return $user;
    }

    public function deleteAccount(User $user)
    {
        if ($user->avatar) {
            Storage::disk("public")->delete($user->avatar);
        }

        $user->delete();

        return ["message" => "Account deleted successfully"];
    }
}
