<?php

namespace App\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ProductDataScope implements Scope
{

    public function apply(Builder $builder, Model $model): void
    {
       $user = auth()->user();
       if($user && $user->hasRole('admin')){
           $builder->select('*');
       }
       else{
           $builder->select('product_id','product_name','description','short_description',
           'price','sale','price_after_sale','category_id','brand_id');
       }
    }
}
