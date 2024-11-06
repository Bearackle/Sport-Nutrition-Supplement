<?php

namespace App\Enum;

enum ShipMethod : int
{
    case TPHCM = 45000;
    case VN = 65000;
    public function is(ShipMethod $value) :bool
    {
        return $this->value == $value;
    }
    public function label() : string{
        return match($this){
            self::TPHCM => __('TPHCM'),
            self::VN => __('VN'),
        };
    }
    public static function equals(string $label): ShipMethod
    {
        $name = strtoupper($label);
        $value =  match($name){
            'TPHCM' => 45000,
            'VN' => 65000,
        };
        return ShipMethod::tryFrom($value);
    }
}
