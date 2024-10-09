<?php

namespace App\Services\Product;

use App\Services\Product\CategoryServiceInterface;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryService implements CategoryServiceInterface{
    protected $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }
    public function getCategoryTrace(){
       return $this->categoryRepository->TraceCategories();
    }
}