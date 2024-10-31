<?php

namespace App\Repositories\Combo;

use App\Repositories\Interfaces\RepositoryInterface;

interface ComboProductRepositoryInterface extends RepositoryInterface{
    public function getAllProductsByComboID($comboId);
}
