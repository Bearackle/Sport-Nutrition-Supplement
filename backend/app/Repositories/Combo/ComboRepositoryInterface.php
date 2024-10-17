<?php

namespace App\Repositories\Combo;

use App\Repositories\Interfaces\RepositoryInterface;

interface ComboRepositoryInterface extends RepositoryInterface{
    public function getComboIDByName($comboName);
    public function searchCombo($searchString);
    public function getComboOfCategory($category_id);
}
