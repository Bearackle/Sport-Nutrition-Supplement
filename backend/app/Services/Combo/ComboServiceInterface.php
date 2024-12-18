<?php

namespace App\Services\Combo;

use App\DTOs\InputData\ComboInputData;
use App\DTOs\InputData\ComboProductInputData;

interface ComboServiceInterface
{
    public function getAllCombos();
    public function getComboOfCategory($categoryId);
    public function getComboById(ComboInputData $combo);
    public function getComboWithProducts(ComboInputData $combo);
    public function updatePriceCombo(ComboInputData $combo);
    public function createCombo(ComboInputData $combo);
    public function addProductCombo(ComboProductInputData $comboProduct);
    public function destroyCombo(ComboInputData $combo);
}
