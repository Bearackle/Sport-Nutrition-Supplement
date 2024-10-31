<?php

namespace App\Repositories\Combo;

use App\Models\ComboProduct;
use App\Repositories\BaseRepository;
use App\Repositories\Combo\ComboProductRepositoryInterface;

class ComboProductRepository extends BaseRepository implements ComboProductRepositoryInterface{
    public function getModel(): string
    {
        return ComboProduct::class;
    }
    public function getAllProductsByComboID($comboId): \Illuminate\Database\Eloquent\Collection
    {
        return ComboProduct::select('product_id','variant_id','quantity')
        ->where('combo_id',$comboId)
        ->get();
    }
}
