<?php

namespace App\Models;

use App\Models\ImageLinkModels\RatingImages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

/**
 * Review
 * @mixin Builder
 */
class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $primaryKey = 'review_id';
    protected $fillable = ['user_id','product_id','combo_id','rating','comment'];
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','user_id');
    }
    public function combo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Combo::class,'combo_id','combo_id');
    }
    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class,'product_id','product_id');
    }
    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RatingImages::class,'review_id','review_id');
    }
}
