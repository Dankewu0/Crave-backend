<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $userService){}
    public function getProfile(Request $request)
    {
        $user = $request->user();
        return $this->userService->getProfile($user);
    }
    public function searchUsers(UserIndexRequest $request)
    {
       $validated = $request->validated();
       $query = $validated['search'] ?? null;
       return $this->userService->searchUsers($query);
    }
      public function updateProfile(UserFormRequest $request)
    {
        $validated = $request->validated();
        $user = $request->user();

        return $this->userService->updateProfile($user, $validated);
    }
        public function changePassword(UserResetPasswordRequest $request)
    {
        $validated = $request->validated();

        try {
            $this->userService->resetPassword(
                $validated['reset_token'],
                $validated['password']
            );
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json(['message' => 'Password changed successfully']);
    }
    public function removeAccount(Request $request)
    {
        $user = $request->user();
        return $this->userService->deleteAccount($user);
    }
}
