<?php

namespace App\Repositories\Combo;

use App\Models\Combo;
use App\Repositories\BaseRepository;

class ComboRepository extends BaseRepository implements ComboRepositoryInterface{
    public function getModel() : string{
        return Combo::class;
    }
    public function getComboIDByName($comboName): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Combo)->select('ComboID')
        ->where('ComboName')
        ->get();
    }
    public function searchCombo($searchString){
        //
    }
    public function getComboOfCategory($category_id): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Combo)->where("ComboID","=",$category_id)
            ->get();
    }

    public function getComboProducts($combo_id)
    {
        return Combo::with('variants')->find($combo_id);
    }
}
