<?php

namespace App\Repositories\Review;

use App\Models\Review;
use App\Repositories\BaseRepository;
use App\Repositories\Review\ReviewRepositoryInterface;


class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface{
    public function getModel() :string{
        return Review::class;
    }
    public function getAllReviewsByProduct($productid): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Review)->where('ProductID', $productid)
            ->orderBy('created_at', 'desc')
            ->with('images')
            ->get();
    }
    public function getAllReivewsByCombo($comboid): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Review)->where('ComboID',$comboid)
            ->orderBy('created_at', 'desc')
            ->with('images')
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
