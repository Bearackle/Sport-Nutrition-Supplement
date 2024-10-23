<?php

namespace App\Enum;

enum PaymentStatus : int
{
    case PENDING = 0;
    case PAID = 1;
    public function is(PaymentStatus $value) :bool {
        return $this->value == $value;
    }
    public static function equals(string $label): PaymentStatus
    {
        $name = strtoupper($label);
        $value =  match($name){
            'PENDING' => 0,
            'PAID' => 1,
        };
        return PaymentStatus::tryFrom($value);
    }
}
