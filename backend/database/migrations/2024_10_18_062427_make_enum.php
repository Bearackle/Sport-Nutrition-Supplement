<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enum\OrderStatus;
use App\Enum\PaymentStatus;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('Status');
            $table->enum('Status',[OrderStatus::PENDING->value,OrderStatus::SHIPPED->value,OrderStatus::DELIVERED->value])
                ->default(OrderStatus::PENDING->value);
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('PaymentStatus');
            $table->enum('PaymentStatus',[PaymentStatus::PENDING->value,PaymentStatus::PAID->value])
                ->default(OrderStatus::PENDING->value);
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
