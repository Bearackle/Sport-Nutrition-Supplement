<?php

namespace App\Repositories\Address;

use App\Models\Address;
use App\Repositories\BaseRepository;

class AddressRepository extends BaseRepository implements AddressRepositoryInterface
{
    public function getModel() : string{
        return Address::class;
    }

    public function getAddressesUser($userid)
    {
        // TODO: Implement getAddressesUser() method.
    }

    public function getLattestAddress($userid)
    {
        // TODO: Implement getLattestAddress() method.
    }
}
