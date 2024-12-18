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
            $table->id('cart_item_id');
            $table->unsignedBigInteger('cart_id'); // FK to shopping_cart
            $table->unsignedBigInteger('product_id')->nullable(); // FK to product
            $table->unsignedBigInteger('variant_id')->nullable(); // FK to product_variant
            $table->unsignedBigInteger('combo_id')->nullable(); // FK to combos
            $table->integer('quantity');
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
