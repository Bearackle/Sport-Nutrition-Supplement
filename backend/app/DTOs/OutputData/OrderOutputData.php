<?php

namespace App\DTOs\OutputData;

use App\Enum\OrderStatus;
use App\Enum\ShipMethod;
use App\Models\Order;
use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class OrderOutputData extends Data
{
    public function __construct(
        public int $order_id,
        public int $user_id,
        public Carbon $order_date,
        public int $total_amount,
        public ?string $note,
        public OrderStatus $status,
        public string|Optional $address_detail,
        public ShipMethod|Optional $shipment_charges
    ){}
}
