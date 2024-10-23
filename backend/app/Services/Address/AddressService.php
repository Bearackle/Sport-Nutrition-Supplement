<?php

namespace App\Services\Address;

use App\Repositories\Address\AddressRepositoryInterface;

class AddressService implements AddressServiceInterface
{
    protected AddressRepositoryInterface $address_repository;
    public function __construct(AddressRepositoryInterface $address_repository)
    {
        $this->address_repository = $address_repository;
    }

    public function createAddress(array $data) :  void
    {
        $this->address_repository->create($data);
    }
    public function deleteAddress($id) :  void
    {
        $this->address_repository->delete($id);
    }
    public function getDefaultAddress($userid)
    {
       return $this->address_repository->getLattestAddress($userid);
    }
    public function getAllAddresses($userid){
        return $this->address_repository->getAddressesUser($userid);
    }

    public function getAddressDetail($address_id)
    {
       return $this->address_repository->find($address_id)->AddressDetail;
    }
}
