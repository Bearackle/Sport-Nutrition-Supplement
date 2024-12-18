<?php

namespace App\Repositories\Review;

use App\Models\Review;
use App\Repositories\BaseRepository;
use App\Repositories\Review\ReviewRepositoryInterface;


class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface{
    public function getModel() :string{
        return Review::class;
    }
    public function getAllReviewsByProduct($productId): \Illuminate\Database\Eloquent\Builder
    {
        return (new Review)->where('product_id', $productId)
            ->orderBy('created_at', 'desc')
            ->with(['images','user']);
    }
    public function getAllReviewsByCombo($comboId): \Illuminate\Database\Eloquent\Builder
    {
        return (new Review)->where('combo_id',$comboId)
            ->orderBy('created_at', 'desc')
            ->with('images','user');
    }
    public function calculateAverageRatingsOfProduct($productId){
        return (new Review)->where('product_id',$productId)
        ->avg('rating');
    }
    public function calculateAverageRatingsOfCombo($comboId){
        return (new Review)->where('combo_id',$comboId)
        ->avg('rating');
    }
}
