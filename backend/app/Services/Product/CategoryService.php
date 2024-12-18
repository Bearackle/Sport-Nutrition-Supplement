<?php

namespace App\Services\Product;

use App\Services\Product\CategoryServiceInterface;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryService implements CategoryServiceInterface{
    protected CategoryRepositoryInterface $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }
    public function getCategoryTrace()
    {
        return $this->categoryRepository->traceCategories();
    }
    public function getTopProductCategories(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->categoryRepository->getSomeProductsByEachCategory();
    }
    public function getChildrenCategories($id){
        return $this->categoryRepository->getChildrenCategory($id);
    }
}
