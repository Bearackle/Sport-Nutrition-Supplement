<?php

namespace App\Enum;

enum OrderStatus : int
{
    case PENDING = 0;
    case SHIPPING = 1;
    case SUCCESS = 2;
    case CANCELLED = 3;
    public function is(OrderStatus $value) :bool
    {
        return $this->value == $value;
    }
    public function label() : string{
        return match($this){
            self::PENDING => __('PENDING'),
            self::SHIPPING => __('SHIPPING'),
            self::SUCCESS => __('SUCCESS'),
            self::CANCELLED => __('CANCELLED'),
        };
    }
public static function equals(string $label): OrderStatus
{
    $name = strtoupper($label);
    $value =  match($name){
        'PENDING' => 0,
        'SHIPPING' => 1,
        'SUCCESS' => 2,
        'CANCELLED' => 3,
    };
    return OrderStatus::tryFrom($value);
}

}
