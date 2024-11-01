<?php

namespace App\DTOs\OutputData\UserData;

use Spatie\LaravelData\Data;

class UserProductOutputData extends Data
{
    public int $product_id;
    public string $product_name;
    public string $description;
    public ?string $short_description;
    public int $price;
    public int $sale;
    public int $price_after_sale;
    public int $category_id;
    public int $brand_id;
}
