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
            $table->id('ProductID');
            $table->string('ProductName');
            $table->text('Description');
            $table->text('Short_Description');
            $table->integer('Price');
            $table->integer('Sale');
            $table->integer('PriceAfterSale');
            $table->integer('StockQuantity');
            $table->unsignedInteger('CategoryID');  // foreign key
            $table->unsignedInteger('BrandID');     // foreign key
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
