<?php

namespace App\Services\Product;

use App\Services\Product\ProductServiceInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;

class ProductService implements ProductServiceInterface{
    protected $productRepository;
    protected $categoryRepository;
    public function __construct(ProductRepositoryInterface $productRepository, 
    CategoryRepositoryInterface $categoryRepository){
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function getAllProductAvailable(){
        return $this->productRepository->getAllAvailableProduct();
    }
    public function getProductOfCategory($category){
        $categoryid = $this->categoryRepository->getCategoryIDByName($category);
        return $this->productRepository->getProductByCategories($categoryid);
    }
    public function getProductOfChildCategory(array $categoryTrace){
        $parentID = $this->categoryRepository->getCategoryIDByName($categoryTrace[0]);
        $children = $this->categoryRepository->getChildrenCategory($parentID);
        $childID  = $children->firstWhere('CategoryName',$categoryTrace[1]);
        return $this->productRepository->getProductByCategories($childID);
    }
    public function insertNewProduct(array $product){
        
    }
}
