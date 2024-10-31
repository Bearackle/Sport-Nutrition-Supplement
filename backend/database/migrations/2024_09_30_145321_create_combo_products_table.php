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
        Schema::create('combo_products', function (Blueprint $table) {
            $table->id('combo_product_id');
            $table->unsignedBigInteger('combo_id'); // foreign key
            $table->unsignedBigInteger('product_id'); // foreign key
            $table->unsignedBigInteger('variant_id')->nullable(); // foreign key
            $table->integer('quantity');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combo_products');
    }
};
