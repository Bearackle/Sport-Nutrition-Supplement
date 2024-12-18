<?php

namespace App\Models;

use App\Models\ImageLinkModels\ProductImages;
use App\Models\ImageLinkModels\RatingImages;
use App\Traits\ProductStockChecking;
use App\Traits\Scopes\ProductDataScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Product
 * @mixin Builder
 */
class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    protected $fillable = ['product_name','short_description','description','price','sale',
        'stock_quantity','category_id','brand_id','price_after_sale'];
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id','category_id');
    }
    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class,'brand_id','brand_id');
    }
    public function variants(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductVariant::class,'product_id','product_id');
    }
    public function orders(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Order::class,'order_details','product_id','order_id');
    }
    public function combos(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Combo::class,'combo_products','product_id','combo_id');
    }
    public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Review::class,'product_id','product_id');
    }
    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductImages::class,'product_id','product_id');
    }
    public function ratings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RatingImages::class,'product_id','product_id');
    }
    public function scopeFilter($query, $filters){
        return $filters->apply($query);
    }
    protected function fullTextWildcards($term)
    {
        // removing symbols used by MySQL
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);

        foreach ($words as $key => $word) {
            /*
             * applying + operator (required word) only big words
             * because smaller ones are not indexed by mysql
             */
            if (strlen($word) >= 1) {
                $words[$key] = '+' . $word  . '*';
            }
        }

        $searchTerm = implode(' ', $words);
        return $searchTerm;
    }
    public function scopeFullTextSearch($query, $columns, $term)
    {
        $query->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $this->fullTextWildcards($term));
        return $query;
    }
}
