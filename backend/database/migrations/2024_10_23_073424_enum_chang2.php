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
            $table->tinyInteger('PaymentStatus')->default(\App\Enum\PaymentStatus::PENDING->value)->change();
            $table->tinyInteger('PaymentMethod')->default(PaymentMethod::COD->value)->change();
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
