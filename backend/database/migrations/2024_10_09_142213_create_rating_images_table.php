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
        Schema::create('rating_images', function (Blueprint $table) {
            $table->id('rating_image_id'); // Đổi từ rt_image_id thành rating_image_id
            $table->unsignedInteger('review_id');
            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedInteger('combo_id')->nullable();
            $table->string('rating_image_url'); // Đổi từ rt_image_url thành rating_image_url
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating_images');
    }
};
