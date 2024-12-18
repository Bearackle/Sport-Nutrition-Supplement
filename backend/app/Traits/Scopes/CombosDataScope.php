<?php

namespace App\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CombosDataScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $user = auth()->user();
        if($user && $user->hasRole('admin')){
            $builder->select('*');
        }
        else {
            $builder->select('combo_id','combo_name','description','price',
            'combo_sale','combo_price_after_sale','combo_image_url','category_id');
        }
    }
}
