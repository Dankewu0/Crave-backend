<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use Exception;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function getProfile(Request $request)
    {
        $user = $request->user();
        return $this->userService->getProfile($user);
    }

    public function searchUsers(Request $request)
    {
        $query = $request->query("search");
        return $this->userService->searchUsers($query);
    }
    public function updateProfile(UserRequest $request)
    {
        $validated = $request->validated();
        $user = $request->user();

        return $this->userService->updateProfile($user, $validated);
    }
    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            "reset_token" => "required|string",
            "password" => "required|string|min:8|confirmed",
        ]);

        try {
            $this->userService->resetPassword(
                $validated["reset_token"],
                $validated["password"],
            );
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 422);
        }

        return response()->json(["message" => "Password changed successfully"]);
    }

    public function removeAccount(Request $request)
    {
        $user = $request->user();
        return $this->userService->deleteAccount($user);
    }
}
