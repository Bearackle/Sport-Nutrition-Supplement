<?php

namespace App\Http\Tranformers;

use App\DTOs\OutputData\ProductOutputData;
use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    public function transform(ProductOutputData $product){
        return [
            'productId' => $product->product_id,
            'productName' => $product->product_name,
            'description' => $product->description,
            'shortDescription' => $product->short_description,
            'price' => $product->price,
            'sale' => $product->sale,
            'priceAfterSale' => $product->price_after_sale,
            'stockQuantity' => $product->stock_quantity,
            'categoryId' => $product->category_id,
            'brandId' => $product->brand_id
        ];
    }
}
