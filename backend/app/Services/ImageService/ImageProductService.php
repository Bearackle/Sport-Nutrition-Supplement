<?php

namespace App\Services\ImageService;

use App\Repositories\Combo\ComboRepositoryInterface;
use App\Repositories\Image\DescriptionImageRepositoryInterface;
use App\Repositories\Image\ProductImageRepositoryInterface;
use Cloudinary\Api\Exception\ApiError;

class ImageProductService implements ImageProductServiceInterface{
    protected ProductImageRepositoryInterface $productImageRepository;
    protected ComboRepositoryInterface $comboRepository;
    protected DescriptionImageRepositoryInterface $descriptionImageRepository;
    public function __construct(ProductImageRepositoryInterface $productImageRepository,
    ComboRepositoryInterface $comboRepository, DescriptionImageRepositoryInterface $descriptionImageRepository)
    {
        $this->productImageRepository = $productImageRepository;
        $this->comboRepository = $comboRepository;
        $this->descriptionImageRepository = $descriptionImageRepository;
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
    public function addImageDescription($image): void
    {
        $image_data = $this->uploadToCloudinary($image);
        $this->descriptionImageRepository->create($image_data);
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
}

