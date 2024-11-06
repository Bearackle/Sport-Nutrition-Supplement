<?php

namespace App\Services\Address;

use App\DTOs\InputData\AddressInputData;
use App\DTOs\InputData\UserInputData;

interface AddressServiceInterface
{
    public function createAddress(AddressInputData $address);
    public function deleteAddress(AddressInputData $address);
    public function getDefaultAddress(UserInputData $user);
    public function getAllAddresses(UserInputData $user);
    public function getAddressDetail(AddressInputData $address);
}
