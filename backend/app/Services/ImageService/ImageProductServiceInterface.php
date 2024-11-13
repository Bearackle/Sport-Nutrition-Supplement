<?php

namespace App\Services\ImageService;

use App\Models\ImageLinkModels\ProductImages;

interface ImageProductServiceInterface
{
    public function addImagesProduct($productId,array $images);
    public function addImageVariants($productId, $variantId,$image);
    public function addImageCombo($comboId, $imageCombo);
    public function addImageDescription($image);
    public function updateUploadedImage($imageId,$image);
    public function uploadToCloudinary($image);
    public function deleteImage($image);
    public function extract_public_id($image_url);
    public function getImageData($image_id);
    public function getDescriptionsImage();
    public function deleteDescriptionsImage($imageId);
    public function addReviewImages($imageDataSource);
    public function deleteReviewImage($publicId);

}
