<?php

namespace App\DTOs\OutputData;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class ComboProductOutputData extends Data
{
    public function __construct(
        public int $combo_product_id,
        public int $combo_id,
        #[MapInputName('product_id_fk')]
        public int $product_id,
        #[MapInputName('variant_id_fk')]
        public int $variant_id,
        public int $quantity,
    ){}
}
