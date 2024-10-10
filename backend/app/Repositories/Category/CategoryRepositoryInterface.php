<?php

namespace App\Repositories\Category;

use App\Repositories\Interfaces\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface{
    public function getChildrenCategory($categoryID);
    public function getCategoryIDByName($categoryName);
    public function getAllChildrenCategoryID($parentid);
    public function TraceCategories();
}
