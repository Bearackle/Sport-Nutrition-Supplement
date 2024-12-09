<?php

namespace App\Services\Address;

use App\DTOs\InputData\AddressInputData;
use App\DTOs\InputData\UserInputData;
use App\DTOs\OutputData\AddressOutputData;

interface AddressServiceInterface
{
    public function createAddress(AddressInputData $address);
    public function deleteAddress(AddressInputData $address);
    public function getDefaultAddress(UserInputData $user);
    public function getAllAddresses(UserInputData $user);
    public function getAddressDetail(AddressInputData $address);
    public function updateAddress(AddressInputData $address);
}
