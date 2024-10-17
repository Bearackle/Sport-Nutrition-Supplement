<?php

namespace App\Services\Combo;

use App\Repositories\Combo\ComboProductRepositoryInterface;
use App\Repositories\Combo\ComboRepositoryInterface;
use App\Services\ImageService\ImageProductService;
use Cloudinary\Api\Exception\ApiError;

class ComboServcie implements ComboServiceInterface
{
    protected ComboRepositoryInterface $combo_repository;
    protected ComboProductRepositoryInterface $combo_product_repository;
    protected ImageProductService  $image_product_service;
    public function __construct(ComboRepositoryInterface $combo_repository, ComboProductRepositoryInterface
    $combo_product_repository ,ImageProductService $image_product_service)
    {
        $this->combo_repository = $combo_repository;
        $this->combo_product_repository = $combo_product_repository;
        $this->image_product_service = $image_product_service;
    }
    public function getAllCombos()
    {
        return $this->combo_repository->getAll();
    }
    public function getComboOfCategory($category_id)
    {
        return $this->combo_repository->getComboOfCategory($category_id);
    }
    public function getComboById($id){
        return $this->combo_repository->find($id);
    }
    public function updatePriceCombo($comboID, array $price) : void
    {
        $this->combo_repository->update($comboID, $price);
    }
    /**
     * @throws ApiError
     */
    public function createCombo(array $combo , $image) : void
    {
       $combo['Cb_PriceAfterSale'] = $combo['Price'] * (1 - ($combo['Cb_Sale'])/100);
       $created_combo = $this->combo_repository->create($combo);
       $this->image_product_service->addImageCombo($created_combo['ComboID'],$combo['Image']);
    }
    public function addProductCombo(array $product): void
    {
        $this->combo_product_repository->create($product);
    }
    public function destroyCombo($combo_id) : void
    {
        $combo =  $this->combo_repository->find($combo_id);
        $combo->products()->detach();
        $this->combo_repository->delete($combo_id);
        $combo_img['PublicId']  = $this->image_product_service->extract_public_id($combo['Cb_ImageUrl']);
        $this->image_product_service->deleteImage($combo_img);
    }
}
