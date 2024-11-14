<?php

namespace App\Http\Controllers\Api;

use App\DTOs\InputData\AddressInputData;
use App\DTOs\InputData\UserInputData;
use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Http\Responses\ApiResponse;
use App\Models\Address;
use App\Models\User;
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
     * @OA\Post(
     *      path="/api/address",
     *      tags={"Address"},
     *      summary="Thêm địa chỉ",
     *      description="Thêm địa chỉ cho ngời dùng",
     *     @OA\RequestBody(
     *           required=true,
     *           @OA\JsonContent(
     *               type="object",
     *               @OA\Property(property="addressDetail", type="string", example="số 1 đường hàn thuyên"),
     *           )
     *      ),
     *     @OA\Response(response=200, description="Thêm thành công",@OA\JsonContent()),
     *     @OA\Response(response=401, description="Không xác thực",@OA\JsonContent()),
     *     @OA\Response (response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     */
    public function store(Request $request): AddressResource
    {
        $this->authorize('create', Address::class);
        /**@var User $user**/
        $user = auth()->user();
        $addressCreated = $this->addressService
            ->createAddress(AddressInputData::factory()->alwaysValidate()->from(['user_id' => $user->user_id],$request->input()));
        return new AddressResource($addressCreated);
    }

    /**
     * Display the specified resource.
     * @throws AuthorizationException
     * @OA\Get(
     *     path="/api/address",
     *     tags={"Address"},
     *     description="Tìm tất cả địa chỉ khả dụng của người dùng",
     *     summary="Tìm tất cả địa chỉ",
     *    @OA\Response(response=200, description="Tìm thành công",@OA\JsonContent()),
     *    @OA\Response(response=401, description="Không xác thực",@OA\JsonContent()),
     *    @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     */
    public function show(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $this->authorize('view', Address::class);
        /**@var User $user**/
        $user = auth()->user();
        $address = $this->addressService->getAllAddresses(UserInputData::from(['user_id' => $user->user_id]));
        return AddressResource::collection($address);
    }
    /**
     * @OA\Get(
     *     path="/api/address/default",
     *     tags={"Address"},
     *     description="Lấy địa chỉ mặc định của nguời dùng (mới nhất)",
     *     summary="Lấy địa chỉ mặc định",
     *     @OA\Response(response=200, description="Tìm sản phẩm thành công",@OA\JsonContent()),
     *     @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
    **/
    public function defaultAddress(): AddressResource
    {
        $addresses = $this->addressService->getDefaultAddress(UserInputData::from(['user_id' => auth()->user()->user_id]));
        return new AddressResource($addresses);
    }
    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     * @OA\Delete (
     *     path="api/address/{id}",
     *     description="Xóa địa chỉ",
     *     summary = "Xóa địa chỉ",
     *     tags={"Address"},
     *          @OA\Parameter(
     *           name="id",
     *           required=true,
     *           in="path",
     *           description="id sản phẩm cần xóa",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(response=200,description="xóa địa chỉ thành công",@OA\JsonContent()),
     *      @OA\Response(response=400, description="xóa địa chỉ thất bại",@OA\JsonContent()),
     *      @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     *  )
     * )
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
