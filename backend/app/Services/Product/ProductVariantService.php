<?php

namespace App\Services\Product;

use App\DTOs\InputData\ProductIntputData;
use App\DTOs\InputData\VariantInputData;
use App\DTOs\OutputData\VariantOutputData;
use App\Repositories\Product\ProductVariantRepositoryInterface;
use App\Services\ImageService\ImageProductServiceInterface;
use App\Traits\ProductStockChecking;
use Illuminate\Contracts\Container\BindingResolutionException;

class ProductVariantService implements ProductVariantServiceInterface
{
    use ProductStockChecking;
    protected ProductVariantRepositoryInterface $productVariantRepository;

    /**
     * @throws BindingResolutionException
     */
    public function __construct(ProductVariantRepositoryInterface $productVariantRepository, ImageProductServiceInterface $imageProductService){
        $this->productVariantRepository = $productVariantRepository;
        $this->setDependency();
    }
    public function getAllProductVariants(ProductIntputData $product){
        return $this->productVariantRepository->getVariantAvailableForProduct($product->product_id);
    }
    public function getVariantsData(ProductIntputData $product){
        return $this->productVariantRepository->getVariantsDataWithImage($product->product_id);
    }
    public function insertProductVariant(VariantInputData $variant) : VariantOutputData
    {
        $variant_created = $this->productVariantRepository->create($variant->toArray());
        $this->createdProductVariant($variant_created,$variant->stock_quantity);
        return VariantOutputData::from($variant_created);
    }
    public function insertDefaultTaste(VariantInputData $variant) : VariantOutputData
    {
        $variant->variant_name = 'tasteless';
        return VariantOutputData::from($this->productVariantRepository->create($variant->toArray()));
    }
    public function updateProductVariant(VariantInputData $variant): bool | VariantOutputData
    {

        $variant_to_update = $this->productVariantRepository->find($variant->variant_id);
        $this->updateVariantStock($variant_to_update, $variant->stock_quantity);
        unset($variant->stock_quantity);
        return VariantOutputData::from($this->productVariantRepository->update($variant->variant_id,$variant->toArray()));
    }
    public function deleteVariant(VariantInputData $variant) : bool
    {
        $variant_to_delete = $this->productVariantRepository->find($variant->variant_id);
        $this->deleteProductVariant($variant_to_delete,$variant->stock_quantity);
        return $this->productVariantRepository->delete($variant->variant_id);
    }
}
