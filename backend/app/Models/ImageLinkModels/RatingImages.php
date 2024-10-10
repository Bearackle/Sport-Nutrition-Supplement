<?php

namespace App\Models\ImageLinkModels;

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
    protected $fillable = ['Rt_ImageID','ReviewID','ProductID','ComboID','Rt_ImageURL'];
    protected $primaryKey = 'Rt_ImageID';
    public function Review(): BelongsTo
    {
        return $this->belongsTo('App\Models\ReviewModels\Review','ReviewID','ReviewID');
    }
    public function Product(): BelongsTo
    {
        return $this->belongsTo('App\Models\ProductModels\Product','ProductID','ProductID');
    }
    public function Combo(): BelongsTo
    {
        return $this->belongsTo('App\Models\ComboModels\Combo','ComboID','ComboID');
    }
}
