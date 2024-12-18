<?php

namespace App\Enum;

enum Rating : int
{
    case STRONGLY_DISAGREE = 1;
    case DISAGREE = 2;
    case NEUTRAL = 3;
    case AGREE = 4;
    case STRONGLY_AGREE = 5;
    public function is(Rating $value) :bool
    {
        return $this->value == $value;
    }
}
