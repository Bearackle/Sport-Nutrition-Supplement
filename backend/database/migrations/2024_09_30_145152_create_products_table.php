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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_name');
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->integer('price');
            $table->integer('sale');
            $table->integer('price_after_sale');
            $table->integer('stock_quantity');
            $table->unsignedInteger('category_id');  // foreign key
            $table->unsignedInteger('brand_id');     // foreign key
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
