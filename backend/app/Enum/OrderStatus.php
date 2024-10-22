<?php

namespace App\Enum;

enum OrderStatus : int
{
    case PENDING = 0;
    case SHIPPED = 1;
    case DELIVERED = 2;
    public function is(OrderStatus $value) :bool
    {
        return $this->value == $value;
    }
    public function label() : string{
        return match($this){
            self::PENDING => __('PENDING'),
            self::SHIPPED => __('SHIPPED'),
            self::DELIVERED => __('DELIVERED'),
        };
    }
public static function equals(string $label): OrderStatus
{
    $name = strtoupper($label);
    $value =  match($name){
        'PENDING' => 0,
        'SHIPPED' => 1,
        'DELIVERED' => 2,
    };
    return OrderStatus::tryFrom($value);
}
}
