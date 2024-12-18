<?php

namespace App\Services\Product;

use App\Repositories\Brand\BrandRepository;

class BrandService implements BrandServcieInterface
{
    protected BrandRepository $brandRepository;
    public function __construct(BrandRepository $brandRepository){
        $this->brandRepository = $brandRepository;
    }
    public function getBrands(){
        return $this->brandRepository->getAll();
    }
}
