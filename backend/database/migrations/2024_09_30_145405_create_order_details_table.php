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
            $table->id('OrderDetailID');
            $table->unsignedBigInteger('OrderID'); // foreign key
            $table->unsignedBigInteger('ProductID')->nullable(); // foreign key
            $table->unsignedBigInteger('VariantID')->nullable(); // foreign key
            $table->unsignedBigInteger('ComboID')->nullable();   // foreign key
            $table->integer('Quantity'); 
            $table->integer('UnitPrice');
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
