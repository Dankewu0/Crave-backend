<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;

Route::prefix("brands")->group(function () {
    Route::get("/", [BrandController::class, "index"]);
    Route::get("{brand}", [BrandController::class, "show"]);

    Route::middleware("auth:sanctum")->group(function () {
        Route::post("/", [BrandController::class, "store"]);
        Route::put("{brand}", [BrandController::class, "update"]);
        Route::delete("{brand}", [BrandController::class, "destroy"]);
    });
});
