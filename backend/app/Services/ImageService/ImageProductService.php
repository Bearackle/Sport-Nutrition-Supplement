<?php

namespace App\Services\ImageService;

use App\Repositories\Combo\ComboRepositoryInterface;
use App\Repositories\Image\ProductImageRepositoryInterface;
use Cloudinary\Api\Exception\ApiError;

class ImageProductService implements ImageProductServiceInterface{
    protected ProductImageRepositoryInterface $productImageRepository;
    protected ComboRepositoryInterface $comboRepository;
    public function __construct(ProductImageRepositoryInterface $productImageRepository,
    ComboRepositoryInterface $comboRepository)
    {
        $this->productImageRepository = $productImageRepository;
        $this->comboRepository = $comboRepository;
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
                ['ProductID' => $productId,
                'VariantID'=> $variantId,'ImageURL'=> $dataUploaded['Url'],
                    'IsPrimary'=> true,'PublicId' => $dataUploaded['PublicId'],]);
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
        $this->comboRepository->update($comboID,
            ['Cb_ImageURL' => $dataUpdated['Url']]);
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
    public function deleteImage($image) : void {
        cloudinary()->destroy($image['PublicId']);
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
}

