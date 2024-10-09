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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('ReviewID');
            $table->unsignedBigInteger('UserID'); //    FK to users
            $table->unsignedBigInteger('ProductID')->nullable(); // FK to products
            $table->unsignedBigInteger('ComboID')->nullable(); // FK to combos
            $table->integer('Rating');
            $table->text('Comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
