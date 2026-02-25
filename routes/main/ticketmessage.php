<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketMessageController;

Route::middleware("auth:sanctum")
    ->prefix("ticket-messages")
    ->group(function () {
        Route::get("/", [TicketMessageController::class, "index"]);
        Route::get("{ticketMessage}", [TicketMessageController::class, "show"]);
        Route::post("/", [TicketMessageController::class, "store"]);
        Route::put("{ticketMessage}", [
            TicketMessageController::class,
            "update",
        ]);
        Route::delete("{ticketMessage}", [
            TicketMessageController::class,
            "destroy",
        ]);
    });
