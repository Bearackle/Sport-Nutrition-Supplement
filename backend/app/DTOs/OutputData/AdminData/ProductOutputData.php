<?php

namespace App\DTOs\OutputData\AdminData;

use Illuminate\Support\Optional;
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
}
