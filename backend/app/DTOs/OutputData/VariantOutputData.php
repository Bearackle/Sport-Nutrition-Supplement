<?php

namespace App\DTOs\OutputData;


use App\DTOs\InputData\ImageData;
use App\Models\ImageLinkModels\ProductImages;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class VariantOutputData extends Data
{
        public int $variant_id;
        public int $product_id;
        public string $variant_name;
        public int|Optional $stock_quantity;
        public ?ProductImages $image;
}
