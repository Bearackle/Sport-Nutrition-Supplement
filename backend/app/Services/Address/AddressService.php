<?php

namespace App\Services\Address;

use App\DTOs\InputData\AddressInputData;
use App\DTOs\InputData\UserInputData;
use App\DTOs\OutputData\AddressOutputData;
use App\Http\Responses\ApiResponse;
use App\Models\Address;
use App\Repositories\Address\AddressRepositoryInterface;

class AddressService implements AddressServiceInterface
{
    protected AddressRepositoryInterface $addressRepository;
    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function createAddress(AddressInputData $address) : AddressOutputData
    {
        $addressCreated = $this->addressRepository->create($address->toArray());
        return AddressOutputData::from($addressCreated);
    }
    public function deleteAddress(AddressInputData $address) :  bool
    {
        return $this->addressRepository->delete($address->address_id);
    }
    public function getDefaultAddress(UserInputData $user) : AddressOutputData | bool
    {
       $address = $this->addressRepository->getAddressesUser($user->user_id)->first();
       if($address == null){
           return false;
       }
       return AddressOutputData::from($address);
    }
    public function getAllAddresses(UserInputData $user): \Illuminate\Contracts\Pagination\Paginator|\Illuminate\Support\Enumerable|array|\Illuminate\Support\Collection|\Illuminate\Support\LazyCollection|\Spatie\LaravelData\PaginatedDataCollection|\Illuminate\Pagination\AbstractCursorPaginator|\Spatie\LaravelData\CursorPaginatedDataCollection|\Spatie\LaravelData\DataCollection|\Illuminate\Pagination\AbstractPaginator|\Illuminate\Contracts\Pagination\CursorPaginator
    {
        return AddressOutputData::collect($this->addressRepository->getAddressesUser($user->user_id));
    }
    public function getAddressDetail(AddressInputData $address): AddressOutputData
    {
       return AddressOutputData::from($this->addressRepository->find($address->address_id));
    }
    public function updateAddress(AddressInputData $address) : AddressOutputData
    {
         $addressUpdated = $this->addressRepository->update($address->address_id, $address->toArray());
         return AddressOutputData::from($addressUpdated);
    }
}
