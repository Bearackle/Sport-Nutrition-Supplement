<?php

namespace App\Http\Controllers\Api;

use App\DTOs\InputData\AddressInputData;
use App\DTOs\InputData\UserInputData;
use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Http\Responses\ApiResponse;
use App\Models\Address;
use App\Services\Address\AddressServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    use AuthorizesRequests;
    protected AddressServiceInterface $addressService;
    public function __construct(AddressServiceInterface $addressService)
    {
        $this->addressService = $addressService;
    }
    /**
     * Store a newly created resource in storage.
     * @throws AuthorizationException
     */
    public function store(Request $request): AddressResource
    {
        $this->authorize('create', Address::class);
        $addressCreated = $this->addressService
            ->createAddress(AddressInputData::factory()->alwaysValidate()->from(['user_id' => auth()->user()->user_id],$request->input()));
        return new AddressResource($addressCreated);
    }

    /**
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $this->authorize('view', Address::class);
        $address = $this->addressService->getAllAddresses(UserInputData::from(['user_id' => auth()->user()->user_id]));
        return AddressResource::collection($address);
    }
    public function defaultAddress(): AddressResource
    {
        $addresses = $this->addressService->getDefaultAddress(UserInputData::from(['user_id' => auth()->user()->user_id]));
        return new AddressResource($addresses);
    }
    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(string $addressId): JsonResponse
    {
        $this->authorize('delete', Address::class);
        $isSuccess = $this->addressService->deleteAddress(AddressInputData::validateAndCreate(['address_id' => $addressId]));
        if($isSuccess) {
            return ApiResponse::success('delete successful');
        }
        return ApiResponse::fail('delete failed');
    }
}
