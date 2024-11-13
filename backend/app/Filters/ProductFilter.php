<?php

namespace App\Filters;

class ProductFilter extends QueryFilter
{
    public function brand($value){
        return $this->builder->where('brand_id',$value);
    }
    public function category($value){
        return $this->builder->where('category_id',$value);
    }
    public function price($values){
        $queryString = preg_replace('/[^0-9]+/',' ',$values);
        $queryString = trim($queryString);
        $prices = explode(" ",$queryString);
        $prices = array_map('intval', $prices);
        return $this->builder->where('price', '>=',$prices[0])
            ->where('price','<=',$prices[1]);
    }
    public function sortbyPrice($value){
        return $this->builder->orderBy('price',$value);
    }
    public function sortbyAlphabetical($value){
        return $this->builder->orderBy('productName',$value);
    }
}
