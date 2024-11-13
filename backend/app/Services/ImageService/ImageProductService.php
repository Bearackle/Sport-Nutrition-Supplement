<?php

namespace App\Services\ImageService;

use App\Jobs\UploadComboImageToCloudinary;
use App\Jobs\UploadImageProductToCloudinary;
use App\Jobs\UploadToCloudinary;
use App\Repositories\Combo\ComboRepositoryInterface;
use App\Repositories\Image\DescriptionImageRepositoryInterface;
use App\Repositories\Image\ProductImageRepositoryInterface;
use App\Repositories\Image\RatingImageRepository;
use App\Repositories\Image\RatingImageRepositoryInterface;
use Cloudinary\Api\Exception\ApiError;
use Illuminate\Support\Facades\Storage;

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
     */
    public function addImageVariants($productId, $variantId, $image): bool
    {
        if(empty($image)){
            return false;
        }
        $dataImage['product_id'] = $productId;
        $dataImage['variant_id'] = $variantId;
        $dataImage['is_primary'] = true;
        $path = Storage::putFile('public/images', $image);
        UploadImageProductToCloudinary::dispatch($path,$dataImage,$this);
        return true;
    }
    /**
     */
    public function addImagesProduct($productId, array $images =[]): bool
    {
        if (empty($images)) {
            return false;
        }
        $dataImage['product_id'] = $productId;
        $dataImage['is_primary'] = true;
        foreach ($images as $image) {
            $path = Storage::putFile('public/images', $image);
            UploadImageProductToCloudinary::dispatch($path,$dataImage,$this);
            $dataImage['is_primary'] = false;
        }
        return true;
    }
    public function storeDBImageProducts(array $dataUploaded) : void {
        $this->productImageRepository->create($dataUploaded);
    }
    /**
     */
    public function addImageCombo($comboId, $imageCombo): bool
    {
        if(empty($imageCombo)){
            return false;
        }
        $path = Storage::putFile('public/images', $imageCombo);
        UploadComboImageToCloudinary::dispatch($path,['combo_id' => $comboId],$this->comboRepository);
        return true;
    }
    /**
     * @throws ApiError
     */
    public function uploadToCloudinary($image): array
    {
       $uploaded =  cloudinary()->upload($image->getRealPath());
       return ['image_url' => $uploaded->getSecurePath(),
           'public_id' => $uploaded->getPublicId()];
    }
    /**
     * @throws ApiError
     */
    public function updateUploadedImage($imageId, $image) : bool
    {
        $img = $this->productImageRepository->find($imageId);
        $path = Storage::putFile('public/images', $image);
        UploadToCloudinary::dispatch($path,$img->toArray());
        return true;
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
        $data = $this->descriptionImageRepository->create($image_data);
        return $data;
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
    public function addReviewImages($imageDataSource): array
    {
        $ratingImageData = [];
        foreach ($imageDataSource as $imageData) {
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

