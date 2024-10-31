<?php

namespace App\Repositories\Review;

use App\Repositories\Interfaces\RepositoryInterface;

interface ReviewRepositoryInterface extends RepositoryInterface{
    public function getAllReviewsByProduct($productId);
    public function getAllReivewsByCombo($comboId);
    public function calculateAverageRatingsOfProduct($productId);
    public function calculateAverageRatingsOfCombo($comboId);
}
