<?php

namespace App\Repositories\Image;

use App\Models\ImageLinkModels\RatingImages;
use App\Repositories\BaseRepository;

class RatingImageRepository extends BaseRepository implements RatingImageRepositoryInterface
{
    public function getModel() : string {
        return RatingImages::class;
    }
}
