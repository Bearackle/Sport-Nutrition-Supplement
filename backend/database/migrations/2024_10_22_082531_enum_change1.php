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
                $table->tinyInteger('Status')->default(\App\Enum\OrderStatus::PENDING->value)->change();
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->tinyInteger('PaymentStatus')->default(\App\Enum\PaymentStatus::PENDING)->change();
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
