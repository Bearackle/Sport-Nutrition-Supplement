<?php

namespace App\Repositories\Review;

use App\Repositories\Interfaces\RepositoryInterface;

interface ReviewRepositoryInterface extends RepositoryInterface{
    public function getAllReviewsByProduct($productid);
    public function getAllReivewsByCombo($comboid);
    public function calculateAverageRatingsOfProduct($productid);
    public function calculateAverageRatingsOfCombo($comboid);
}