<?php

namespace App\Enum;

enum PaymentMethod : int
{
    case INTERNET_BANKING = 0;
    case VN_PAY = 1;
    case COD = 2;
    public function is(PaymentMethod $value) :bool {
        return $this->value == $value;
    }
    public static function equals(string $label): PaymentMethod
    {
        $name = strtoupper($label);
        $value =  match($name){
            'INTERNET_BANKING' => 0,
            'VN_PAY' => 1,
            'COD' => 2,
        };
        return PaymentMethod::tryFrom($value);
    }
}
