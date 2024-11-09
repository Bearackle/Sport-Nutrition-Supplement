<?php

namespace App\Services\Review;

use App\DTOs\InputData\ComboInputData;
use App\DTOs\InputData\ImageData;
use App\DTOs\InputData\ProductIntputData;
use App\DTOs\InputData\ReviewInputData;
use App\DTOs\InputData\UserInputData;

interface ReviewServiceInterface
{
    public function addReview(ReviewInputData $review);
    public function getReviewsOfProduct(ProductIntputData $product);
    public function getReviewsOfCombo(ComboInputData $combo);
    public function addImagestoReview(ReviewInputData $review, array $images);
    public function deleteImageReview($imageId);
    public function updateReview(ReviewInputData $review);
    public function deleteReview(ReviewInputData $review);
    public function getReviewData(ReviewInputData $review);
    public function findReviewModel(ReviewInputData $review);
}
