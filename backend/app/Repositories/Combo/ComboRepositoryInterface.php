<?php

namespace App\Repositories\Combo;

use App\Repositories\Interfaces\RepositoryInterface;

interface ComboRepositoryInterface extends RepositoryInterface{
    public function getComboIdByName($comboName);
    public function searchCombo($searchString);
    public function getComboOfCategory($categoryId);
    public function getComboProducts($comboId);
}
