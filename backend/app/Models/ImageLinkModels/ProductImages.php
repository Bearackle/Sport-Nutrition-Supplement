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
    protected $fillable = ['image_id','product_id','variant_id','image_url','is_primary','public_id'];
    protected $primaryKey = 'image_id';
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id','product_id');
    }
    public function variant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductVariant::class,'variant_id','variant_id');
    }
}
