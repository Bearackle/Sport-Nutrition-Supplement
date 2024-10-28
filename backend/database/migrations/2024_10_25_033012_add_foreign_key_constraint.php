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
            $table->foreign('ParentID')
                ->references('CategoryID')
                ->on('categories');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('CategoryID')
                ->references('CategoryID')
                ->on('categories');
            $table->foreign('BrandID')
                ->references('BrandID')
                ->on('brands');
        });
        Schema::table('product_variants', function (Blueprint $table) {
            $table->foreign('ProductID')
                ->references('ProductID')
                ->on('products');
        });
        Schema::table('combos' , function(Blueprint $table){
            $table->foreign('CategoryID')
                ->references('CategoryID')
                ->on('categories');
        });
        Schema::table('combo_products' , function(Blueprint $table){
            $table->foreign('ComboID')
                ->references('ComboID')
                ->on('combos');
            $table->foreign('ProductID')
                ->references('ProductID')
                ->on('products');
            $table->foreign('VariantID')
                ->references('VariantID')
                ->on('product_variants');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('UserID')
                ->references('userid')
                ->on('users');
        });
        Schema::table('order_details', function (Blueprint $table) {
            $table->foreign('OrderID')
                ->references('OrderID')
                ->on('orders');
            $table->foreign('ProductID')
                ->references('ProductID')
                ->on('products');
            $table->foreign('ComboID')
                ->references('ComboID')
                ->on('combos');
            $table->foreign('VariantID')
                ->references('VariantID')
                ->on('product_variants');
        });
        Schema::table('shopping_carts', function (Blueprint $table) {
            $table->foreign('UserID')
            ->references('userid')->on('users');
        });
        Schema::table('cart_items', function (Blueprint $table) {
            $table->foreign('CartID')
                ->references('CartID')->on('shopping_carts');
            $table->foreign('ProductID')
                ->references('ProductID')
                ->on('products');
            $table->foreign('VariantID')
                ->references('VariantID')
                ->on('product_variants');
            $table->foreign('ComboID')
                ->references('ComboID')->on('combos');
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('OrderID')
                ->references('OrderID')->on('orders');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('UserID')
                ->references('userid')->on('users');
            $table->foreign('ProductID')
                ->references('ProductID')->on('products');
            $table->foreign('ComboID')
                ->references('ComboID')->on('combos');
        });
        Schema::table('addresses', function (Blueprint $table) {
            $table->foreign('UserID')
                ->references('userid')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
