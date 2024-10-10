<?php

namespace App\Repositories\Brand;

use App\Models\Brand;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\RepositoryInterface;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{
    public function getModel(): string
    {
        return Brand::class;
    }
}
