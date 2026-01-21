<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::prefix("users")->group(function () {
    Route::get("search", [UserController::class, "searchUsers"]);
    Route::post("password/reset", [UserController::class, "changePassword"]);

    Route::middleware("auth:sanctum")->group(function () {
        Route::get("profile", [UserController::class, "getProfile"]);
        Route::put("profile", [UserController::class, "updateProfile"]);
        Route::delete("account", [UserController::class, "removeAccount"]);
    });
});
