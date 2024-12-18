<?php

namespace App\Repositories\Address;

use App\Repositories\Interfaces\RepositoryInterface;

interface AddressRepositoryInterface extends RepositoryInterface
{
    public function getAddressesUser($userId);
}
