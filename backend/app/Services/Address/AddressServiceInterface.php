<?php

namespace App\Services\Address;

interface AddressServiceInterface
{
    public function createAddress(array $data);
    public function deleteAddress($id);
    public function getDefaultAddress($userid);
    public function getAllAddresses($userid);
    public function getAddressDetail($address_id);
}
