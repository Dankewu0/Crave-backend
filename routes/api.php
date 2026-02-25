<?php

use Illuminate\Support\Facades\Route;

Route::prefix("v1")->group(function () {
    require __DIR__ . "/main/user.php";
    require __DIR__ . "/main/shop.php";
    require __DIR__ . "/main/category.php";
    require __DIR__ . "/main/brand.php";
    require __DIR__ . "/main/product.php";
    require __DIR__ . "/main/image.php";
    require __DIR__ . "/main/cart.php";
    require __DIR__ . "/main/order.php";
    require __DIR__ . "/main/review.php";
    require __DIR__ . "/main/conversation.php";
    require __DIR__ . "/main/message.php";
    require __DIR__ . "/main/ticket.php";
    require __DIR__ . "/main/ticketmessage.php";
});
