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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('order_detail_id');
            $table->unsignedBigInteger('order_id'); // foreign key
            $table->unsignedBigInteger('product_id')->nullable(); // foreign key
            $table->unsignedBigInteger('variant_id')->nullable(); // foreign key
            $table->unsignedBigInteger('combo_id')->nullable();   // foreign key
            $table->integer('quantity');
            $table->integer('unit_price');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
