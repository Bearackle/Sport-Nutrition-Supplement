<?php

namespace App\DTOs\OutputData;

use App\DTOs\Casts\EnumAutoCast;
use App\Enum\PaymentMethod;
use App\Enum\PaymentStatus;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class PaymentOutputData extends Data
{
    public function __construct(
        public int|Optional $payment_id,
        public int|Optional $order_id,
        public PaymentMethod $payment_method,
        public PaymentStatus $payment_status,
        public Carbon $payment_date,
    ){}
}
