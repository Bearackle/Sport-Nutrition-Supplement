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
        Schema::create('combos', function (Blueprint $table) {
            $table->id('ComboID');
            $table->string('ComboName');
            $table->text('Description');
            $table->integer('Price');
            $table->integer('Cb_Sale');
            $table->integer('Cb_PriceAfterSale');
            $table->string('Cb_ImageUrl');
            $table->unsignedBigInteger('CategoryID');  // foreign key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combos');
    }
};
