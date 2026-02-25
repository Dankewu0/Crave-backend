<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::middleware("auth:sanctum")
    ->prefix("tickets")
    ->group(function () {
        Route::get("/", [TicketController::class, "index"]);
        Route::get("{ticket}", [TicketController::class, "show"]);
        Route::post("/", [TicketController::class, "store"]);
        Route::put("{ticket}", [TicketController::class, "update"]);
        Route::delete("{ticket}", [TicketController::class, "destroy"]);
    });
