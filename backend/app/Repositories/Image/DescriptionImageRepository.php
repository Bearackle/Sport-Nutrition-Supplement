<?php

namespace App\Repositories\Image;

use App\Models\ImageLinkModels\ImageDescription;
use App\Repositories\BaseRepository;

class DescriptionImageRepository extends BaseRepository implements DescriptionImageRepositoryInterface
{
    public function getModel() : string{
        return ImageDescription::class;
    }
}
