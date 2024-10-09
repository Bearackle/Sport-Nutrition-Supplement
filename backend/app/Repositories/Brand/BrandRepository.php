<?php

namespace App\Repositories\Brand;

use App\Models\Brand;
use App\Repositories\Interfaces\RepositoryInterface;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{
    public function getModel(){
        return Brand::class;
    }
    public function getBrandIDByName($brandName){
        return Brand::where('BrandName',$brandName);
    }
}