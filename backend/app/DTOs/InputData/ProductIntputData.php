<?php

namespace App\DTOs\InputData;

use Illuminate\Support\Optional;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;
#[MapInputName(CamelCaseMapper::class)]

class ProductIntputData extends Data
{
    #[Exists('products, product_id')]
    public int|Optional $product_id;
    public string|Optional $product_name;
    public string|Optional $description;
    public string|Optional $short_description;
    public int|Optional $price;
    public int|Optional $sale;
    public int|Optional $stock_quantity;
    #[Exists('categories, category_id')]
    public int|Optional $category_id;
    #[Exists('brands, brand_id')]
    public int|Optional $brand_id;
}
