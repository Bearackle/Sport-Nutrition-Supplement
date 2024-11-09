<?php

namespace App\Services\Review;

use App\DTOs\InputData\ComboInputData;
use App\DTOs\InputData\ImageData;
use App\DTOs\InputData\ProductIntputData;
use App\DTOs\InputData\ReviewInputData;
use App\DTOs\OutputData\ReviewOutputData;
use App\Models\Review;
use App\Models\User;
use App\Repositories\Combo\ComboRepositoryInterface;
use App\Repositories\Image\RatingImageRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Review\ReviewRepositoryInterface;
use App\Services\ImageService\ImageProductService;
use Cloudinary\Api\Exception\ApiError;

class ReviewService implements ReviewServiceInterface
{
    protected ReviewRepositoryInterface $review_repository;
    protected RatingImageRepositoryInterface $rating_image_repository;
    protected ImageProductService  $imageProductService;
    protected ProductRepositoryInterface $product_repository;
    protected ComboRepositoryInterface $combo_repository;
    public function __construct(ReviewRepositoryInterface $review_repository, RatingImageRepositoryInterface $rating_image_repository,
    ImageProductService $imageProductService, ProductRepositoryInterface $product_repository, ComboRepositoryInterface $combo_repository){
        $this->review_repository = $review_repository;
        $this->rating_image_repository = $rating_image_repository;
        $this->imageProductService = $imageProductService;
        $this->product_repository = $product_repository;
        $this->combo_repository = $combo_repository;
    }
    /**
     * @throws ApiError
     */
    public function addReview(ReviewInputData $review): ReviewOutputData
    {
        $review = $this->review_repository->create($review->toArray());
        return ReviewOutputData::from($review);
    }

    public function getReviewsOfProduct(ProductIntputData $product)
    {
        return $this->review_repository->getAllReviewsByProduct($product->product_id)->simplePaginate(5);
    }
    public function getReviewsOfCombo(ComboInputData $combo): \Illuminate\Contracts\Pagination\Paginator|\Illuminate\Support\Enumerable|array|\Illuminate\Support\Collection|\Illuminate\Support\LazyCollection|\Spatie\LaravelData\PaginatedDataCollection|\Illuminate\Pagination\AbstractCursorPaginator|\Spatie\LaravelData\CursorPaginatedDataCollection|\Spatie\LaravelData\DataCollection|\Illuminate\Pagination\AbstractPaginator|\Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->review_repository->getAllReviewsByCombo($combo->combo_id)->simplePaginate(5);
    }
    public function updateReview(ReviewInputData $review) : ReviewOutputData
    {
        $updatedReview = $this->review_repository->update($review->review_id, ['comment' => $review->comment,
            'rating' => $review->rating]);
        return ReviewOutputData::from($updatedReview);
    }
    public function deleteReview(ReviewInputData $review): bool
    {
        $reviewModel = $this->findReviewModel($review);
        foreach ($reviewModel->images as $image) {
            $publicId = $this->imageProductService->extract_public_id($image->rating_image_url);
            $this->imageProductService->deleteReviewImage($publicId);
        }
        $reviewModel->images()->delete();
        return $this->review_repository->delete($review->review_id);
    }
    public function getReviewData(ReviewInputData $review)
    {
       return $this->review_repository->find($review->review_id);
    }
    public function findReviewModel(ReviewInputData $review)
    {
        return $this->review_repository->find($review->review_id);
    }
    /**
     * @param ReviewInputData $review
     * @return bool
     * @throws ApiError
     * @var array<ImageData> $image
     */
    public function addImagestoReview(ReviewInputData $review, array $images) : bool
    {
        $urls = $this->imageProductService->addReviewImages($images);
        $imageReviewInput = $review->only('review_id','product_id','combo_id')->toArray();
        foreach ($urls as $url) {
            $imageReviewInput['rating_image_url'] = $url;
            $this->rating_image_repository->create($imageReviewInput);
        }
        return true;
    }
    public function deleteImageReview($imageId): void
    {
        $image = $this->rating_image_repository->find($imageId);
        /**@var User $user**/
        $user = auth()->user();
        if($user->can('delete',$image->review)) {
            $image = $this->rating_image_repository->find($imageId);
            $this->imageProductService->deleteReviewImage($this->imageProductService->extract_public_id($image->rating_image_url));
            $image->delete();
        }
    }
}
