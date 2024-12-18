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
        Schema::table('orders', function (Blueprint $table) {
            $table->tinyInteger('status')->default(\App\Enum\OrderStatus::PENDING->value)->change(); // Chuyển thành snake_case
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->tinyInteger('payment_status')->default(\App\Enum\PaymentStatus::PENDING->value)->change(); // Chuyển thành snake_case
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
