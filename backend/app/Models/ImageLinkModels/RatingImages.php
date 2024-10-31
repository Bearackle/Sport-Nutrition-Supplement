<?php

namespace App\Models\ImageLinkModels;

use App\Models\Combo;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * RatingImages
 * @mixin Builder
 */

class RatingImages extends Model
{
    use HasFactory;
    protected $table = 'rating_images';
    protected $fillable = ['rating_image_id','review_id','product_id','combo_id','rating_image_url'];
    protected $primaryKey = 'rating_image_id';
    public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class,'review_id','review_id');
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id','product_id');
    }
    public function combo(): BelongsTo
    {
        return $this->belongsTo(Combo::class, 'combo_id','combo_id');
    }
}
