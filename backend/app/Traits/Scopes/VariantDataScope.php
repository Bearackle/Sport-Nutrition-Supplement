<?php

namespace App\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class VariantDataScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $user = auth()->user();
        if($user && $user->hasRole('admin')){
            $builder->select('*');
        } else
        {
            $builder->select('variant_id','product_id','variant_name');
        }
    }
}
