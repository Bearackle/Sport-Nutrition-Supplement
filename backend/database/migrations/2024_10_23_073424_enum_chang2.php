<?php

use App\Enum\PaymentMethod;
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
        Schema::table('payments', function (Blueprint $table) {
            $table->tinyInteger('payment_status')->default(\App\Enum\PaymentStatus::PENDING->value)->change(); // Chuyển thành snake_case
            $table->tinyInteger('payment_method')->default(\App\Enum\PaymentMethod::COD->value)->change(); // Chuyển thành snake_case
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
