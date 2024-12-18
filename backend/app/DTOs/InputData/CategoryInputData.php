<?php

namespace App\DTOs\InputData;

use Illuminate\Support\Optional;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;
class CategoryInputData extends Data
{
    #[Exists('categories, category_id'),MapInputName('category_id')]
    public int|Optional $category_id;
    public string|Optional $category_name;
}
