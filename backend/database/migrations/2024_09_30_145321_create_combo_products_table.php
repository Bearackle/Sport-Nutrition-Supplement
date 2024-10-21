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
            $table->id('ComboProductID');
            $table->unsignedBigInteger('ComboID'); // foreign key
            $table->unsignedBigInteger('ProductID'); // foreign key
            $table->unsignedBigInteger('VariantID')->nullable(); // foreign key
            $table->integer('Quantity');
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
