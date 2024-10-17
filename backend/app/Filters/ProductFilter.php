<?php

namespace App\Filters;

class ProductFilter extends QueryFilter
{
    public function brand($value){
        return $this->builder->where('BrandID',$value);
    }
    public function category($value){
        return $this->builder->where('CategoryID',$value);
    }
    public function price($values){
        $array = json_decode($values, true);
        return $this->builder->where('Price', '>=',$array[0])
            ->where('Price','<=',$array[1]);
    }
    public function sortbyPrice($value){
        return $this->builder->orderBy('Price',$value);
    }
    public function sortbyAlphabetical($value){
        return $this->builder->orderBy('ProductName',$value);
    }
}
