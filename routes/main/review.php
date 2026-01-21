<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;

Route::prefix("reviews")->group(function () {
    Route::get("product/{productId}", [ReviewController::class, "index"]);

    Route::middleware("auth:sanctum")->group(function () {
        Route::post("/", [ReviewController::class, "store"]);
        Route::delete("{review}", [ReviewController::class, "destroy"]);
    });
});
