<?php

namespace App\Services\Combo;

interface ComboServiceInterface
{
    public function getAllCombos();
    public function getComboOfCategory($categoryId);
    public function getComboById($id);
    public function getComboProducts($id);
    public function updatePriceCombo($comboId,array $price);
    public function createCombo(array $combo);
    public function addProductCombo(array $product);
    public function destroyCombo($comboId);
}
