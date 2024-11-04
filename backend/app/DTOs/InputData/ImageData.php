<?php

namespace App\DTOs\InputData;


use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Image;
use Spatie\LaravelData\Attributes\Validation\Mimes;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapInputName(CamelCaseMapper::class)]
class ImageData extends Data
{
    #[Image, Mimes(['jpeg', 'png','webp'])]
   public UploadedFile $image;
}
