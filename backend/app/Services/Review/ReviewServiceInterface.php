<?php

namespace App\Services\Review;

interface ReviewServiceInterface
{
    public function addReview($userid, array $data);
    public function getReviewsOfProduct($product_id);
    public function getReviewsOfCombo($combo_id);
    public function addImagetoReview($review_id,array $data);
    public function deleteImageOfReview($image_id);
    public function updateReview($review_id,array $data);
    public function deleteReview($review_id);
    public function getReviewData($review_id);
}
