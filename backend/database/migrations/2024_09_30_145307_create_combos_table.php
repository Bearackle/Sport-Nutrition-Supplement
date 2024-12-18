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
            $table->id('combo_id');
            $table->string('combo_name');
            $table->text('description');
            $table->integer('price');
            $table->integer('combo_sale');            // đã chuyển từ cb_sale thành combo_sale
            $table->integer('combo_price_after_sale'); // đã chuyển từ cb_priceAfterSale thành combo_price_after_sale
            $table->string('combo_image_url')->nullable(); // đã chuyển từ cb_ImageUrl thành combo_image_url
            $table->unsignedInteger('category_id');   // foreign key
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
