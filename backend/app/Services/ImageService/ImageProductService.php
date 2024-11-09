<?php

namespace App\Services\ImageService;

use App\Http\Resources\ImageResource;
use App\Http\Responses\ApiResponse;
use App\Repositories\Combo\ComboRepositoryInterface;
use App\Repositories\Image\DescriptionImageRepositoryInterface;
use App\Repositories\Image\ProductImageRepositoryInterface;
use App\Repositories\Image\RatingImageRepository;
use App\Repositories\Image\RatingImageRepositoryInterface;
use Cloudinary\Api\Exception\ApiError;

class ImageProductService implements ImageProductServiceInterface{
    protected ProductImageRepositoryInterface $productImageRepository;
    protected ComboRepositoryInterface $comboRepository;
    protected DescriptionImageRepositoryInterface $descriptionImageRepository;
    protected RatingImageRepository $ratingImageRepository;
    public function __construct(ProductImageRepositoryInterface $productImageRepository,
    ComboRepositoryInterface $comboRepository, DescriptionImageRepositoryInterface $descriptionImageRepository,
    RatingImageRepositoryInterface $ratingImageRepository)
    {
        $this->productImageRepository = $productImageRepository;
        $this->comboRepository = $comboRepository;
        $this->descriptionImageRepository = $descriptionImageRepository;
        $this->ratingImageRepository = $ratingImageRepository;
    }
    /**
     * @throws ApiError
     */
    public function addImageVariants($productId, $variantId, $image): bool
    {
        if(empty($image)){
            return false;
        }
            $dataUploaded = $this->uploadToCloudinary($image);
            $this->productImageRepository->create(
                ['product_id' => $productId,
                'variant_id'=> $variantId,'image_url'=> $dataUploaded['image_url'],
                    'is_primary'=> true,'public_id' => $dataUploaded['public_id'],]);
        return true;
    }
    /**
     * @throws ApiError
     */
    public function addImagesProduct($productId, array $images =[]): bool
    {
        if (empty($images)) {
            return false;
        }
        $isFirst = true;
        foreach ($images as $image) {
            $dataUploaded = $this->uploadToCloudinary($image);
            $this->productImageRepository->create(['product_id' => $productId,
                'image_url' => $dataUploaded['image_url'],
                'public_id' => $dataUploaded['public_id'],
                'is_primary' => $isFirst]);
            $isFirst = false;
        }
        return true;
    }

    /**
     * @throws ApiError
     */
    public function addImageCombo($comboID, $imageCombo): bool
    {
        if(empty($imageCombo)){
            return false;
        }
        $dataUpdated = $this->uploadToCloudinary($imageCombo);
        $this->comboRepository->update($comboID,
            ['combo_image_url' => $dataUpdated['image_url']]);
        return true;
    }

    /**
     * @throws ApiError
     */
    public function uploadToCloudinary($image): array
    {
       $uploaded =  cloudinary() ->upload($image->getRealPath());
       return ['image_url' => $uploaded->getSecurePath(),
           'public_id' => $uploaded->getPublicId()];
    }
    /**
     * @throws ApiError
     */
    public function updateUploadedImage($imageId, $image) : void
    {
        $img = $this->productImageRepository->find($imageId);
        $result = cloudinary()->upload($image->getRealPath(),[
            'public_id' => $img['public_id'],
            'overwrite' => true,
        ]);
    }
    public function deleteImage($image) : void {
        cloudinary()->destroy($image->public_id);
        $image->delete();
    }
    public function deleteComboImage($combo): void
    {
        $publicId = $this->extract_public_id($combo->combo_image_url);
        cloudinary()->destroy($publicId);
    }
    public function extract_public_id($image_url) : string{
        $last_backslash = strrpos($image_url,'/');
        $last_dot = strrpos($image_url,'.');
        return substr($image_url, $last_backslash+1,$last_dot-$last_backslash-1);
    }
    public function getImageData($image_id)
    {
       return $this->productImageRepository->find($image_id);
    }
    /**
     * @throws ApiError
     */
    public function addImageDescription($image)
    {
        $image_data = $this->uploadToCloudinary($image);
        return $this->descriptionImageRepository->create($image_data);
    }

    public function getDescriptionsImage()
    {
        return $this->descriptionImageRepository->getAll()->sortByDesc('created_at');
    }

    public function deleteDescriptionsImage($imageId) : void
    {
        $image = $this->descriptionImageRepository->find($imageId);
        $this->deleteImage($image);
        $image->delete();
    }

    /**
     * @throws ApiError
     */
    public function addReviewImages($imageDatas): array
    {
        $ratingImageData = [];
        foreach ($imageDatas as $imageData) {
            $imageData = $this->uploadToCloudinary($imageData->image);
            $ratingImageData[] = $imageData['image_url'];
        }
        return $ratingImageData;
    }

    public function deleteReviewImage($publicId): void
    {
        cloudinary()->destroy($publicId);
    }
}

