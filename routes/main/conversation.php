<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversationController;

Route::middleware("auth:sanctum")
    ->prefix("conversations")
    ->group(function () {
        Route::get("/", [ConversationController::class, "index"]);
        Route::get("{conversation}", [ConversationController::class, "show"]);
        Route::post("/", [ConversationController::class, "store"]);
        Route::put("{conversation}", [ConversationController::class, "update"]);
        Route::delete("{conversation}", [
            ConversationController::class,
            "destroy",
        ]);
    });
