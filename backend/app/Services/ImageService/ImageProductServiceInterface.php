<?php

namespace App\Services\ImageService;

interface ImageProductServiceInterface
{
    public function addImagesProduct($productId,array $images);
    public function addImageVariants($productId, $variantId,$image);
    public function addImageCombo($comboID, $imageCombo);
    public function updateUploadedImage($imageId,$image);
    public function uploadToCloudinary($image);
}
