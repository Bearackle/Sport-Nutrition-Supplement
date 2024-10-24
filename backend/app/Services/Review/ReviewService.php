<?php

namespace App\Services\Review;

use App\Repositories\Combo\ComboRepositoryInterface;
use App\Repositories\Image\RatingImageRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Reivew\ReviewRepository;
use App\Repositories\Review\ReviewRepositoryInterface;
use App\Services\ImageService\ImageProductService;
use Cloudinary\Api\Exception\ApiError;

class ReviewService implements ReviewServiceInterface
{
    protected ReviewRepositoryInterface $review_repository;
    protected RatingImageRepositoryInterface $rating_image_repository;
    protected ImageProductService  $image_product_service;
    protected ProductRepositoryInterface $product_repository;
    protected ComboRepositoryInterface $combo_repository;
    public function __construct(ReviewRepositoryInterface $review_repository, RatingImageRepositoryInterface $rating_image_repository,
    ImageProductService $image_product_service, ProductRepositoryInterface $product_repository, ComboRepositoryInterface $combo_repository){
        $this->review_repository = $review_repository;
        $this->rating_image_repository = $rating_image_repository;
        $this->image_product_service = $image_product_service;
        $this->product_repository = $product_repository;
        $this->combo_repository = $combo_repository;
    }

    /**
     * @throws ApiError
     */
    public function addReview($userid, array $data) :  void
    {
        $data['UserID'] = $userid;
        $review = $this->review_repository->create($data);
        if(!empty($data['images'])){
            $this->addImagetoReview($review->ReviewID, $data);}
    }

    public function getReviewsOfProduct($product_id)
    {
        return $this->review_repository->getAllReviewsByProduct($product_id);
    }

    public function getReviewsOfCombo($combo_id)
    {
        return $this->review_repository->getAllReivewsByCombo($combo_id);
    }

    /**
     * @throws ApiError
     */
    public function addImagetoReview($review_id,array $data) : void
    {
        $images = $data['images'];
        $data['ReviewID'] = $review_id;
        unset($data['images']);
        foreach($images as $image){
            $data_image = $this->image_product_service->uploadToCloudinary($image);
            $data['Rt_ImageURL'] = $data_image['Url'];
            $this->rating_image_repository->create($data);
        }
    }

    public function deleteImageOfReview($image_id)  : void
    {
        $image = $this->rating_image_repository->find($image_id);
        $image['PublicId'] = $this->image_product_service->extract_public_id($image->Rt_ImageURL);
        $this->image_product_service->deleteImage($image);
        $this->rating_image_repository->delete($image_id);
    }
    public function updateReview($review_id, array $data) : void
    {
        $this->review_repository->update($review_id, ['Comment' => $data['Comment'],
            'Rating' => $data['Rating']]);
    }

    public function deleteReview($review_id): void
    {
        $this->review_repository->delete($review_id);
    }

    public function getReviewData($review_id)
    {
       return $this->review_repository->find($review_id);

    }
}
