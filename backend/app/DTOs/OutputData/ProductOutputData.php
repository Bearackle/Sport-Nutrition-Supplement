<?php

namespace App\DTOs\OutputData;

use Illuminate\Support\Collection;
use Illuminate\Support\Optional;
use Spatie\LaravelData\Attributes\LoadRelation;
use Spatie\LaravelData\Data;

class ProductOutputData extends Data
{
    public int $product_id;
    public string $product_name;
    public string $description;
    public string|Optional $short_description;
    public int $price;
    public int $sale;
    public int $price_after_sale;
    public int $stock_quantity;
    public int $category_id;
    public int $brand_id;
    #[LoadRelation]
    public Collection $images; // ten thuoc tinh phai trung voi relation
}
