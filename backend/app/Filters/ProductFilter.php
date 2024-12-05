<?php

namespace App\Filters;

use MongoDB\BSON\Int64;
use PhpParser\Builder;

class ProductFilter extends QueryFilter
{
    public function brand($value){
        return $this->builder->where('brand_id',$value);
    }
    public function category($value){
        return $this->builder->where('category_id',$value);
    }
    public function priceFrom($value){
        $this->builder->where('price_after_sale', '>=',$value);
    }
    public function priceTo($value){
        $this->builder->where('price_after_sale', '<=',$value);
    }
    public function sortbyPrice($value){
        return $this->builder->orderBy('price_after_sale',$value);
    }
    public function sortbyAlphabetical($value){
        return $this->builder->orderBy('product_name',$value);
    }
}
