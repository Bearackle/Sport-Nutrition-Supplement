<?php

namespace App\Services\Product;

interface CategoryServiceInterface{
    public function getCategoryTrace();
    public function getTopProductCategories();
    public function getChildrenCategories($id);
}
