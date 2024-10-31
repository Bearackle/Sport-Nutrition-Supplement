<?php

namespace App\Services\Address;

use App\Repositories\Address\AddressRepositoryInterface;

class AddressService implements AddressServiceInterface
{
    protected AddressRepositoryInterface $addressRepository;
    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function createAddress(array $data) :  void
    {
        $this->addressRepository->create($data);
    }
    public function deleteAddress($id) :  void
    {
        $this->addressRepository->delete($id);
    }
    public function getDefaultAddress($userId)
    {
       return $this->addressRepository->getAddressesUser($userId)->first();
    }
    public function getAllAddresses($userId){
        return $this->addressRepository->getAddressesUser($userId);
    }

    public function getAddressDetail($addressId)
    {
       return $this->addressRepository->find($addressId)->address_detail;
    }
}
