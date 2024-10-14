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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id('ImageID');
            $table->unsignedBigInteger('ProductID');
            $table->unsignedBigInteger('VariantID')->nullable();
            $table->string('ImageURL')->nullable();
            $table->boolean('IsPrimary');
            $table->string('PublicId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
