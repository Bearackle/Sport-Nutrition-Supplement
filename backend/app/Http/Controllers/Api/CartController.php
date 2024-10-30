<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartIdRequest;
use App\Http\Requests\NewCartItems;
use App\Http\Requests\NewCartRequest;
use App\Http\Responses\ApiResponse;
use App\Services\Order\CartServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use mysql_xdevapi\Collection;

class CartController extends Controller
{
    protected CartServiceInterface $cartService;
    public function __construct(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }
    /**
     * @OA\Get(
     *     path="/api/cart/{id}",
     *     summary="id của giỏ hàng",
     *     description="Lấy id của giỏ hàng bằng id của user",
     *     tags={"Cart"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="id của user",
     *     ),
     *     @OA\Response(response=200, description="Tìm thông tin giỏ hàng thành công"),
     *     @OA\Response(response=400, description="Tìm thông tin giỏ hàng thất bại"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ")
     * )
     */
    public function index(string $id)
    {
        return $this->cartService->getCart($id);
    }

    /**
     * @OA\Post(
     *     path="/api/cart/new",
     *     tags={"Cart"},
     *     description="Tạo giỏ hàng mới cho user, lưu ý mỗi user chỉ có 1 giỏ hàng",
     *     summary="Tạo giỏ hàng",
     *     @OA\RequestBody(
     *         required=true,
     *          @OA\JsonContent(
     *              type="object",
     *          @OA\Property (property="UserID", type="integer",example=2),
     *          )
     *     ),
     *     @OA\Response(response=200,description="Tạo giỏ hàng thành công"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ"),
     * )
     */
    public function newCart(NewCartRequest $request): ApiResponse
    {
        $this->cartService->createCart($request->get('UserID'));
        return ApiResponse::success('created successful');
    }
    /**
     * @OA\Post(
     *     path="/api/cart/item",
     *     tags={"Cart"},
     *     summary="Thêm sản phẩm vào giỏ hàng",
     *     description="Thêm sản phẩm vào giỏ hàng, lưu ý khi thêm product thì combo có thể để null hoặc không liệt kê vào request, tương tự với combo" ,
     *     @OA\RequestBody(
     *         required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property (property="CartID", type="integer", example=1),
     *              @OA\Property (property="ProductID", type="integer", example=30, nullable=true),
     *              @OA\Property (property="VariantID", type="integer", example=13, nullable=true),
     *              @OA\Property (property="ComboID", type="integer", example=null, nullable=true),
     *              @OA\Property (property="Quantity",type="integer", example=2)
     *          )
     *     ),
     *     @OA\Response(response=200, description="Thêm vào giỏ hàng thành công"),
     *     @OA\Response(response=422, description="Sản phẩm đã tồn tại"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ")
     * )
     */
    public function store(NewCartItems $request) : ApiResponse
    {
        $this->cartService->addCartItem($request->validated());
        return ApiResponse::success('create successful');
    }
    /**
     * @OA\Get(
     *     path="/api/cart/all/{id}",
     *     tags={"Cart"},
     *     description="Tìm thông tin toàn bộ sản phẩm có trong giỏ hàng",
     *     summary="sản phẩm trong giỏ hàng",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id của giỏ hàng",
     *         required=true
     *     ),
     *     @OA\Response(response=200, description="Tìm sản phẩm thành công"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ")
     * )
     */
    public function show(string $id): ApiResponse
    {
        return new ApiResponse(200,$this->cartService->getItems($id)->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(CartIdRequest $request) : ApiResponse
    {
        $request->validate([
            'Quantity' => 'required|numeric']);
        $this->cartService->updateCartItemQuantity($request->all());
        return ApiResponse::success('update successful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartIdRequest $request) : ApiResponse
    {
        $this->cartService->deleteCartItem($request->all());
        return ApiResponse::success('deleted successfully');
    }
}
