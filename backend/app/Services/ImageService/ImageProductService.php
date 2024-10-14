<?php

namespace App\Services\ImageService;

use App\Repositories\Product\ProductImageRepositoryInterface;
use Cloudinary\Api\Exception\ApiError;

class ImageProductService implements ImageProductServiceInterface{
    protected ProductImageRepositoryInterface $productImageRepository;
    public function __construct(ProductImageRepositoryInterface $productImageRepository)
    {
        $this->productImageRepository = $productImageRepository;
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
            $this->productImageRepository->create(['ProductID' => $productId,
                'VariantID'=>$variantId,
                'IsPrimary'=>true,
                'ImageUrl'=>$dataUploaded['Url'],
                'PublicId' => $dataUploaded['PublicId'],]);
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
            $this->productImageRepository->create(['ProductID' => $productId,
                'ImageURL' => $dataUploaded['Url'],
                'PublicId' => $dataUploaded['PublicId'],
                'IsPrimary' => $isFirst]);
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
        $this->productImageRepository->update($comboID,
            ['Cb_ImageUrl' => $dataUpdated]);
        return true;
    }

    /**
     * @throws ApiError
     */
    public function uploadToCloudinary($image): array
    {
       $uploaded =  cloudinary() ->upload($image->getRealPath());
       return ['Url' => $uploaded->getSecurePath(),
           'PublicId' => $uploaded->getPublicId()];
    }
    /**
     * @throws ApiError
     */
    public function updateUploadedImage($imageId, $image) : void
    {
        $img = $this->productImageRepository->find($imageId);
        $result = cloudinary()->upload($image->getRealPath(),[
            'public_id' => $img['PublicId'],
            'overwrite' => true,
        ]);
    }
}

