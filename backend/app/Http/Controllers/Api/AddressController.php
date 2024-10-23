<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Address\AddressServiceInterface;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected AddressServiceInterface $address_service;
    public function __construct(AddressServiceInterface $address_service)
    {
        $this->address_service = $address_service;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->address_service->createAddress($request->all());
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return $this->address_service->getAllAddresses($request->UserID);
    }
    public function defaultAddress(Request $request){
        return $this->address_service->getDefaultAddress($request->UserID);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $address)
    {
        return $this->address_service->deleteAddress($address->addressid);
    }
}
