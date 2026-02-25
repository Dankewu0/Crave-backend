<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

Route::middleware("auth:sanctum")
    ->prefix("messages")
    ->group(function () {
        Route::get("/", [MessageController::class, "index"]);
        Route::get("{message}", [MessageController::class, "show"]);
        Route::post("/", [MessageController::class, "store"]);
        Route::put("{message}", [MessageController::class, "update"]);
        Route::delete("{message}", [MessageController::class, "destroy"]);
    });
