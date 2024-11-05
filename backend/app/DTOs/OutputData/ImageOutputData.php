<?php

namespace App\DTOs\OutputData;

use Carbon\Carbon;

class ImageOutputData
{
    public function __construct(
        public int $image_id,
        public string $image_url,
        public string $public_id,
        public Carbon $create_at
    ){}
}
