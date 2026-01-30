<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::prefix("products")->group(function () {
    Route::get("/", [ProductController::class, "index"]);
    Route::get("{product}", [ProductController::class, "show"]);

    Route::middleware("auth:sanctum")->group(function () {
        Route::post("/", [ProductController::class, "store"]);
        Route::put("{product}", [ProductController::class, "update"]);
        Route::delete("{product}", [ProductController::class, "destroy"]);
    });
});
