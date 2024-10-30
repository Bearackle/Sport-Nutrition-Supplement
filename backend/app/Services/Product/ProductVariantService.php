<?php

namespace App\Services\Product;

use App\Events\ImageDeleted;
use App\Events\ProductVariantCreated;
use App\Events\ProductVariantDeleted;
use App\Http\Responses\ApiResponse;
use App\Models\ProductVariant;
use App\Repositories\Product\ProductVariantRepository;
use App\Repositories\Product\ProductVariantRepositoryInterface;
use App\Services\ImageService\ImageProductServiceInterface;
use App\Traits\ProductStockChecking;
use Illuminate\Contracts\Container\BindingResolutionException;

class ProductVariantService implements ProductVariantServiceInterface
{
    use ProductStockChecking;
    protected ProductVariantRepositoryInterface $productVariantRepository;
    protected ImageProductServiceInterface $imageProductService;

    /**
     * @throws BindingResolutionException
     */
    public function __construct(ProductVariantRepositoryInterface $productVariantRepository, ImageProductServiceInterface $imageProductService){
        $this->productVariantRepository = $productVariantRepository;
        $this->imageProductService = $imageProductService;
        $this->setDependency();
    }
    public function getAllProductVariants($productID){
        return $this->productVariantRepository->getVariantAvailableForProduct($productID);
    }
    public function getVariantsData($productID){
        return $this->productVariantRepository->getVariantsDataWithImage($productID);
    }
    public function insertProductVariant(array $productVariant)
    {
        $result = $this->productVariantRepository->create($productVariant);
        $this->createdProductVariant($productVariant,$productVariant['StockQuantity']);
        return $result;
    }
    public function updateProductVariant($id, array $productVariant): bool | ProductVariant
    {
        $variant = $this->productVariantRepository->find($id);
        $this->updateVariantStock($variant,$productVariant['StockQuantity']);
        unset($productVariant['StockQuantity']);
        return $this->productVariantRepository->update($id,$productVariant);
    }
    public function deleteVariant($variantId): void
    {
        $variant = $this->productVariantRepository->find($variantId);
        $this->deleteProductVariant($variant,$variant['StockQuantity']);
        $this->productVariantRepository->delete($variantId);
    }
}
