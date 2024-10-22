<?php

use App\Enum\OrderStatus;
use App\Enum\PaymentStatus;
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
            $table->enum('Status',[OrderStatus::PENDING->value,OrderStatus::SHIPPED->value,OrderStatus::DELIVERED->value]);
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->enum('PaymentStatus',[PaymentStatus::PENDING->value,PaymentStatus::PAID->value])->change();
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
