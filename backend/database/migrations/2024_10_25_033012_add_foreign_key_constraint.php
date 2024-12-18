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
        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('parent_id') // Chuyển thành snake_case
            ->references('category_id')
                ->on('categories');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_id') // Chuyển thành snake_case
            ->references('category_id')
                ->on('categories');
            $table->foreign('brand_id') // Chuyển thành snake_case
            ->references('brand_id')
                ->on('brands');
        });

        Schema::table('product_variants', function (Blueprint $table) {
            $table->foreign('product_id') // Chuyển thành snake_case
            ->references('product_id')
                ->on('products');
        });

        Schema::table('combos', function (Blueprint $table) {
            $table->foreign('category_id') // Chuyển thành snake_case
            ->references('category_id')
                ->on('categories');
        });

        Schema::table('combo_products', function (Blueprint $table) {
            $table->foreign('combo_id') // Chuyển thành snake_case
            ->references('combo_id')
                ->on('combos');
            $table->foreign('product_id') // Chuyển thành snake_case
            ->references('product_id')
                ->on('products');
            $table->foreign('variant_id') // Chuyển thành snake_case
            ->references('variant_id')
                ->on('product_variants');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('user_id') // Chuyển thành snake_case
            ->references('user_id')
                ->on('users');
        });

        Schema::table('order_details', function (Blueprint $table) {
            $table->foreign('order_id') // Chuyển thành snake_case
            ->references('order_id')
                ->on('orders');
            $table->foreign('product_id') // Chuyển thành snake_case
            ->references('product_id')
                ->on('products');
            $table->foreign('combo_id') // Chuyển thành snake_case
            ->references('combo_id')
                ->on('combos');
            $table->foreign('variant_id') // Chuyển thành snake_case
            ->references('variant_id')
                ->on('product_variants');
        });

        Schema::table('shopping_carts', function (Blueprint $table) {
            $table->foreign('user_id') // Chuyển thành snake_case
            ->references('user_id')
                ->on('users');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->foreign('cart_id') // Chuyển thành snake_case
            ->references('cart_id')
                ->on('shopping_carts');
            $table->foreign('product_id') // Chuyển thành snake_case
            ->references('product_id')
                ->on('products');
            $table->foreign('variant_id') // Chuyển thành snake_case
            ->references('variant_id')
                ->on('product_variants');
            $table->foreign('combo_id') // Chuyển thành snake_case
            ->references('combo_id')
                ->on('combos');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('order_id') // Chuyển thành snake_case
            ->references('order_id')
                ->on('orders');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('user_id') // Chuyển thành snake_case
            ->references('user_id')
                ->on('users');
            $table->foreign('product_id') // Chuyển thành snake_case
            ->references('product_id')
                ->on('products');
            $table->foreign('combo_id') // Chuyển thành snake_case
            ->references('combo_id')
                ->on('combos');
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->foreign('user_id') // Chuyển thành snake_case
            ->references('user_id')
                ->on('users');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
