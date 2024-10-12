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
            $url = $this->uploadToCloudinary($image);
            $this->productImageRepository->create(['ProductID'=>$productId,
                'VariantID'=>$variantId,
                'ImageUrl'=>$url,]);
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
            $url = $this->uploadToCloudinary($image);
            $this->productImageRepository->create(['ProductID' => $productId,
                'ImageURL' => $url,
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
        $url = $this->uploadToCloudinary($imageCombo);
        $this->productImageRepository->create(['ComboID' => $comboID,
            'Cb_ImageUrl' => $url,]);
        return true;
    }

    /**
     * @throws ApiError
     */
    public function uploadToCloudinary($image)
    {
       // return cloudinary() ->upload($image->getRealPath())->getSecurePath();
        return null;
    }
}

