<?php

namespace App\Models;

use App\Traits\Scopes\CombosDataScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Combo
 * @mixin Builder
 */
class Combo extends Model
{
    use HasFactory;
    protected $fillable = ['combo_name','description','price','combo_sale','combo_price_after_sale','combo_image_url','category_id'];
    protected $primaryKey = 'combo_id';
    protected $table = 'combos';
    public function orders(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Order::class,'order_details','combo_id','order_id');
    }
    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class,'combo_products','combo_id','product_id_fk')
            ->withPivot('quantity');
    }
    public function variants(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ProductVariant::class, 'combo_products', 'combo_id', 'variant_id_fk')
            ->withPivot('quantity');
    }
    public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Review::class,'combo_id','combo_id');
    }
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id','category_id');
    }
    protected static function booted(): void
    {
        static::addGlobalScope(new CombosDataScope());
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
