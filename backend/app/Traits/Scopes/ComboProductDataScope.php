<?php

namespace App\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ComboProductDataScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        $user = auth()->user();
        if($user && $user->hasRole('admin')){
            $builder->select('*');
        }
        else {
            $builder->select('combo_product_id','combo_id',
                'product_id','variant_id');
        }
    }
}
