<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;

Route::prefix("shops")->group(function () {
    Route::get("/", [ShopController::class, "index"]);

    Route::middleware("auth:sanctum")->group(function () {
        Route::post("/", [ShopController::class, "store"]);
        Route::delete("{id}", [ShopController::class, "destroy"]);
    });
});
