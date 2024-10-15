<?php

namespace App\Services\ImageService;

use App\Models\ImageLinkModels\ProductImages;

interface ImageProductServiceInterface
{
    public function addImagesProduct($productId,array $images);
    public function addImageVariants($productId, $variantId,$image);
    public function addImageCombo($comboID, $imageCombo);
    public function updateUploadedImage($imageId,$image);
    public function uploadToCloudinary($image);
    public function deleteImage(ProductImages $image);
}
