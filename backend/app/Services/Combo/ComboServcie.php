<?php

namespace App\Services\Combo;

use App\DTOs\InputData\ComboInputData;
use App\DTOs\InputData\ComboProductInputData;
use App\DTOs\OutputData\ComboOutputData;
use App\DTOs\OutputData\ComboProductOutputData;
use App\DTOs\OutputData\VariantOutputData;
use App\Http\Resources\CombosLandingMask;
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
    public function getAllCombos(): \Illuminate\Contracts\Pagination\Paginator
    {
        return $this->combo_repository->getAvailableCombos()->paginate(10);
    }
    public function getComboOfCategory($categoryId): \Illuminate\Contracts\Pagination\Paginator|\Illuminate\Support\Enumerable|array|\Illuminate\Support\Collection|\Illuminate\Support\LazyCollection|\Spatie\LaravelData\PaginatedDataCollection|\Illuminate\Pagination\AbstractCursorPaginator|\Spatie\LaravelData\CursorPaginatedDataCollection|\Spatie\LaravelData\DataCollection|\Illuminate\Pagination\AbstractPaginator|\Illuminate\Contracts\Pagination\CursorPaginator
    {
        return ComboOutputData::collect($this->combo_repository->getComboOfCategory($categoryId));
    }
    public function getComboById(ComboInputData $combo): ComboOutputData
    {
        return ComboOutputData::from($this->combo_repository->find($combo->combo_id));
    }
    public function updatePriceCombo(ComboInputData $combo): ComboOutputData
    {
        return ComboOutputData::from($this->combo_repository->update($combo->combo_id,
            ['price' => $combo->price, 'sale' => $combo->combo_sale]));
    }
    /**
     */
    public function createCombo(ComboInputData $combo): ComboOutputData
    {
       $combo->combo_price_after_sale = $combo->price * (1 - ($combo->combo_sale)/100);
       return ComboOutputData::from($this->combo_repository->create($combo->toArray()));
    }
    public function addProductCombo(ComboProductInputData $comboProduct): ComboProductOutputData
    {
        return ComboProductOutputData::from($this->combo_product_repository
            ->create($comboProduct->toArray()));
    }
    public function destroyCombo(ComboInputData $combo) : void
    {
        $combo_to_destroy =  $this->combo_repository->find($combo->combo_id);
        $combo_to_destroy->products()->detach();
        $this->image_product_service->deleteComboImage($combo_to_destroy);
        $this->combo_repository->update($combo->combo_id,['price' => -1]);
    }
    public function getComboWithProducts(ComboInputData $combo)
    {
       return $this->combo_repository
                   ->getComboWithProducts($combo->combo_id);
    }
}
