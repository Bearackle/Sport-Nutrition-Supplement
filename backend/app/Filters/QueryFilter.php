<?php

namespace App\Filters;



use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected $builder;
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;
        foreach($this->filters() as $filter => $value){
            if(method_exists($this,$filter)){
                $this->$filter($value);
            }
        }
        return $this->builder;
    }
    public function filters(): array
    {
        return $this->request->all();
    }
}
