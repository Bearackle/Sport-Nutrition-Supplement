<?php

namespace App\Repositories\Combo;

use App\Models\Combo;
use App\Repositories\BaseRepository;

class ComboRepository extends BaseRepository implements ComboRepositoryInterface{
    public function getModel(){
        return Combo::class;
    }
    public function getComboIDByName($comboName){
        return Combo::select('ComboID')
        ->where('ComboName')
        ->get();
    }
    public function getAvailableCombo(){
        return Combo::select('ComboID','ComboName')
        ->get();
    }
    public function searchCombo($searchString){
        //
    }
}