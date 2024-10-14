<?php

namespace App\Models\ImageLinkModels;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * ProductImages
 * @mixin Builder
 */
class ProductImages extends Model
{
    use HasFactory;
    protected $table = 'product_images';
    protected $fillable = ['ImageID','ProductID','VariantID','ImageURL','IsPrimary','PublicId'];
    protected $primaryKey = 'ImageID';
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class,'ProductID','ProductID');
    }
    public function variant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductVariant::class,'VariantID','VariantID');
    }
}
