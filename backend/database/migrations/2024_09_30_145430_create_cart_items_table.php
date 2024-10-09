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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id('CartItemID');
            $table->unsignedBigInteger('CartID'); //FK to phopping_cart
            $table->unsignedBigInteger('ProductID')->nullable(); // FK to product
            $table->unsignedBigInteger('VariantID')->nullable(); // FK to product_variant
            $table->unsignedBigInteger('ComboID')->nullable(); // FK to combos
            $table->integer('Quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
