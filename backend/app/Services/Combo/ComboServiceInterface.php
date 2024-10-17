<?php

namespace App\Services\Combo;

interface ComboServiceInterface
{
    public function getAllCombos();
    public function getComboOfCategory($category_id);
    public function getComboById($id);
    public function updatePriceCombo($comboID,array $price);
    public function createCombo(array $combo,$image);
    public function addProductCombo(array $product);
    public function destroyCombo($combo_id);
}
