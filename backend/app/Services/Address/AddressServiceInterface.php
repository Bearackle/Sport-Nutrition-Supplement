<?php

namespace App\Services\Address;

interface AddressServiceInterface
{
    public function createAddress(array $data);
    public function deleteAddress($id);
    public function getDefaultAddress($userId);
    public function getAllAddresses($userId);
    public function getAddressDetail($addressId);
}
