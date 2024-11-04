<?php

namespace App\DTOs\OutputData;

use App\Enum\PaymentStatus;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class PaymentOutputData extends Data
{
    public function __construct(
        #[Exists('payments,payment_id')]
        public int|Optional $payment_id,
        #[Exists('orders, order_id')]
        public int|Optional $order_id,
        public PaymentStatus|Optional $payment_method,
        public Carbon $payment_date,
    ){}
}
