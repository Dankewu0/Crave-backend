<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::prefix("categories")->group(function () {
    Route::get("/", [CategoryController::class, "index"]);
    Route::get("{category}", [CategoryController::class, "show"]);

    Route::middleware("auth:sanctum")->group(function () {
        Route::post("/", [CategoryController::class, "store"]);
        Route::put("{category}", [CategoryController::class, "update"]);
        Route::delete("{category}", [CategoryController::class, "destroy"]);
    });
});
