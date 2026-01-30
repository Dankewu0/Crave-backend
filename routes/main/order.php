<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::middleware("auth:sanctum")
    ->prefix("orders")
    ->group(function () {
        Route::get("/", [OrderController::class, "index"]);
        Route::post("/", [OrderController::class, "store"]);
        Route::get("{order}", [OrderController::class, "show"]);
        Route::patch("{order}", [OrderController::class, "update"]);
    });
