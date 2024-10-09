<?php

namespace App\Repositories\Combo;

use App\Models\ComboProduct;
use App\Repositories\BaseRepository;
use App\Repositories\Combo\ComboProductRepositoryInterface;

class ComboProductRepository extends BaseRepository implements ComboProductRepositoryInterface{
    public function getModel(){
        return ComboProduct::class;
    }
    public function getAllProductsByComboID($comboID){
        return ComboProduct::select('ProductID','VariantID','Quantity')
        ->where('ComboID',$comboID)
        ->get();
    }
}
