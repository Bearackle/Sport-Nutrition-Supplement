<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface {
    public function getModel(): string
    {
        return Category::class;
    }
    public function getChildrenCategory($categoryId): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Category)->where('parent_id',$categoryId)->get();
    }
    public function getCategoryIDByName($categoryName){
        return (new \App\Models\Category)->select('category_id')->
        where('category_name',$categoryName)
        ->first();
    }
    public function getAllChildrenCategoryID($parentId): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Category)->select('category_id')
        ->where('parent_id',$parentId)
        ->get();
    }
    public function traceCategories() : \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Category)->whereNull('parent_id')
            ->with('children')->get();
    }
    public function getSomeProductsByEachCategory(): \Illuminate\Database\Eloquent\Collection
    {
        return Category::with('products')->orderBy('update_at')
            ->get(10);
    }
}
