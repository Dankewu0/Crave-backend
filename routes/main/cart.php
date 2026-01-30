<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::middleware("auth:sanctum")
    ->prefix("cart")
    ->group(function () {
        Route::get("/", [CartController::class, "index"]);
        Route::post("items", [CartController::class, "store"]);
        Route::patch("items/{itemId}", [CartController::class, "update"]);
        Route::delete("items/{itemId}", [CartController::class, "destroy"]);
    });
