<?php

namespace App\Enum;

enum OrderStatus : int
{
    case PENDING = 0;
    case SHIPPED = 1;
    case DELIVERED = 2;
    public function is(OrderStatus $value) :bool {
        return $this->value == $value;
    }
}
