<?php

namespace App\Repositories\Reivew;

use App\Models\Review;
use App\Repositories\BaseRepository;
use App\Repositories\Review\ReviewRepositoryInterface;


class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface{
    public function getModel(){
        return Review::class;
    }   
    public function getAllReviewsByProduct($productid){
        return Review::select('ReviewID','UserID','Rating','Comment','CreatedAt')
        ->where('ProductID',$productid)
        ->get();
    }
    public function getAllReivewsByCombo($comboid){
        return Review::select('ReviewID','UserID','Rating','Comment','CreatedAt')
        ->where('ComboID',$comboid)
        ->get();
    }
    public function calculateAverageRatingsOfProduct($productid){
        return Review::where('ProductID',$productid)
        ->avg('Rating');
    }
    public function calculateAverageRatingsOfCombo($comboid){
        return Review::where('ComboID',$comboid)
        ->avg('Rating');
    }
}