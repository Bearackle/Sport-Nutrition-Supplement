<?php

namespace App\DTOs\InputData;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapInputName(CamelCaseMapper::class)]
class UserInputUpdatePasswordData extends Data
{
   public string $old_password;
   public string $password;
   public string $confirm_password;
}
