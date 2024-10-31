<?php

namespace App\Repositories\Review;

use App\Models\Review;
use App\Repositories\BaseRepository;
use App\Repositories\Review\ReviewRepositoryInterface;


class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface{
    public function getModel() :string{
        return Review::class;
    }
    public function getAllReviewsByProduct($productId): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Review)->where('product_id', $productId)
            ->orderBy('created_at', 'desc')
            ->with('images')
            ->get();
    }
    public function getAllReivewsByCombo($comboId): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Review)->where('combo_id',$comboId)
            ->orderBy('created_at', 'desc')
            ->with('images')
            ->get();
    }
    public function calculateAverageRatingsOfProduct($productId){
        return Review::where('product_id',$productId)
        ->avg('rating');
    }
    public function calculateAverageRatingsOfCombo($comboId){
        return Review::where('combo_id',$comboId)
        ->avg('rating');
    }
}
