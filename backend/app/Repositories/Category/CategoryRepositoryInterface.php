<?php

namespace App\Repositories\Category;

use App\Repositories\Interfaces\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface{
    public function getChildrenCategory($categoryId);
    public function getCategoryIDByName($categoryName);
    public function getAllChildrenCategoryID($parentId);
    public function traceCategories();
}
