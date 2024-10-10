<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface {
    public function getModel(): string
    {
        return Category::class;
    }
    public function getChildrenCategory($categoryID): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Category)->where('ParentID',$categoryID)->get();
    }
    public function getCategoryIDByName($categoryName){
        return (new \App\Models\Category)->select('CategoryID')->
        where('CategoryName',$categoryName)
        ->first();
    }
    public function getAllChildrenCategoryID($parentid): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Category)->select('CategoryID')
        ->where('ParentID',$parentid)
        ->get();
    }
    public function TraceCategories() : \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Category)->whereNull('ParentID')
            ->with('children')->get();
    }
    public function getSomeProductsByEachCategory(): \Illuminate\Database\Eloquent\Collection
    {
        return Category::with('products')->orderBy('update_at')
            ->get(10);
    }
}
