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
    protected $primaryKey = 'ReviewID';
    protected $fillable = ['UserID','ProductID','ComboID','Rating','Comment'];
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'UserID','userid');
    }
    public function combo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Combo::class,'ComboID','ComboID');
    }
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class,'ProductID','ProductID');
    }
    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RatingImages::class,'ReviewID','ReviewID');
    }
}
