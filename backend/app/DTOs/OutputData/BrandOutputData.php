<?php

namespace App\DTOs\OutputData;

class BrandOutputData
{
    public function __construct(
        public int $brand_id,
        public string $brand_name
    ){}
}
