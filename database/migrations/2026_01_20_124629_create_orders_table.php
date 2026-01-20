<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->max(255);
            $table->string('address')->max(255);
            $table->string('phone')->max(255);
            $table->string('email')->max(255);
            $table->string('status')->max(255);
            $table->string('payment_method')->max(255);
            $table->string('user_id')->max(255);
            $table->string('product_id')->max(255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
