<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

Route::middleware("auth:sanctum")
    ->prefix("images")
    ->group(function () {
        Route::post("/", [ImageController::class, "store"]);
        Route::delete("{image}", [ImageController::class, "destroy"]);
    });
