<?php

namespace App\Repositories\Address;

use App\Models\Address;
use App\Repositories\BaseRepository;

class AddressRepository extends BaseRepository implements AddressRepositoryInterface
{
    public function getModel() : string{
        return Address::class;
    }

    public function getAddressesUser($userId): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\Address)->where('user_id',$userId)->orderBy('address_id','DESC')->get();
    }
}
