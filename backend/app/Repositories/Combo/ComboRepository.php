<?php

namespace App\Repositories\Combo;

use App\Models\Combo;
use App\Repositories\BaseRepository;

class ComboRepository extends BaseRepository implements ComboRepositoryInterface{
    public function getModel() : string{
        return Combo::class;
    }
    public function getComboIdByName($comboName): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Combo)->select('combo_id')
        ->where('combo_name', $comboName)
        ->get();
    }
    public function searchCombo($searchString){
        //
    }
    public function getComboOfCategory($categoryId): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Combo)->where("category_id","=",$categoryId)
            ->get();
    }

    public function getComboProducts($comboId)
    {
        return Combo::with('variants')->find($comboId);
    }
}
