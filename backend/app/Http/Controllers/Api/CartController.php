<?php

namespace App\Http\Controllers\Api;

use App\DTOs\InputData\CartItemInputData;
use App\DTOs\InputData\ShoppingCartInputData;
use App\DTOs\InputData\UserInputData;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartItemResource;
use App\Http\Resources\CartItemsResource;
use App\Http\Resources\ShoppingCartResource;
use App\Http\Responses\ApiResponse;
use App\Models\ShoppingCart;
use App\Models\User;
use App\Services\Order\CartServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use AuthorizesRequests;
    protected CartServiceInterface $cartService;
    public function __construct(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @OA\Get(
     *     path="/api/cart",
     *     summary="lấy id của giỏ hàng",
     *     description="Lấy thông tin giỏ hàng",
     *     tags={"Cart"},
     *     @OA\Response(response=200, description="Tìm thông tin giỏ hàng thành công"),
     *     @OA\Response(response=400, description="Tìm thông tin giỏ hàng thất bại"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ")
     * )
     * @throws AuthorizationException
     */
    public function index(): ShoppingCartResource
    {
        $this->authorize('view', ShoppingCart::class);
        /**@var User $user**/
        $user = auth()->user();
        $user = UserInputData::from(['user_id' => $user->user_id]);
        return new ShoppingCartResource($this->cartService->getCart($user));
    }
    /**
     * @OA\Post(
     *     path="/api/cart/new",
     *     tags={"Cart"},
     *     description="Tạo giỏ hàng mới cho user, lưu ý mỗi user chỉ có 1 giỏ hàng",
     *     summary="Tạo giỏ hàng",
     *     @OA\Response(response=200,description="Tạo giỏ hàng thành công"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ"),
     * )
     */
    public function newCart() : ShoppingCartResource
    {
        /**@var User $user**/
        $user = auth()->user();
        $cart = ShoppingCartInputData::validateAndCreate(['user_id' => $user->user_id]);
        $cartOutput = $this->cartService->createCart($cart);
        return new ShoppingCartResource($cartOutput);
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
     *              @OA\Property (property="cartId", type="integer", example=1),
     *              @OA\Property (property="productId", type="integer", example=30, nullable=true),
     *              @OA\Property (property="variantId", type="integer", example=13, nullable=true),
     *              @OA\Property (property="comboId", type="integer", example=null, nullable=true),
     *              @OA\Property (property="quantity",type="integer", example=2)
     *          )
     *     ),
     *     @OA\Response(response=200, description="Thêm vào giỏ hàng thành công"),
     *     @OA\Response(response=422, description="Sản phẩm đã tồn tại"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ")
     * )
     */
    public function store(Request $request): CartItemResource
    {
        $cartItem = CartItemInputData::validateAndCreate($request->input());
        $cartItemAdded = $this->cartService->addCartItem($cartItem);
        return new CartItemResource($cartItemAdded);
    }
    /**
     * @OA\Get(
     *     path="/api/cart/all",
     *     tags={"Cart"},
     *     description="Tìm thông tin toàn bộ sản phẩm có trong giỏ hàng",
     *     summary="sản phẩm trong giỏ hàng",
     *     @OA\Response(response=200, description="Tìm sản phẩm thành công"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ")
     * )
     * @throws AuthorizationException
     */
    public function show(): CartItemsResource
    {
        $this->authorize('view', ShoppingCart::class);
        /**@var User $user**/
        $user = auth()->user();
        $cart = $this->cartService->getCart(UserInputData::from(['user_id' => $user->user_id]));
        $cartWithItems = $this->cartService->getItems(ShoppingCartInputData::validateAndCreate(['cart_id' => $cart->cart_id]));
        return new CartItemsResource($cartWithItems);
    }
    /**
     * @OA\Patch(
     *     path="/api/cart/item/{item_id}",
     *     description="cập nhật số lượng sản phẩm trong giỏ hàng",
     *     summary="cập nhật số lượng sản phẩm",
     *     tags={"Cart"},
     *     @OA\Parameter (
     *         in="path",
     *         name="item_id",
     *         description="id của phần tử trong giỏ hàng",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property (property="quantity", example=20)
     *          )
     *     ),
     *     @OA\Response(response=200, description="Cập nhật sản phẩm thành công"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ")
     * )
     */
    public function update(Request $request,string $id): JsonResponse|CartItemResource
    {
        $cartItemtoUpdate = CartItemInputData::factory()->alwaysValidate()->from(['cart_item_id' => $id], $request->input());
        $cartItemUpdated = $this->cartService->updateCartItemQuantity($cartItemtoUpdate);
        if($cartItemUpdated){
            return new CartItemResource($cartItemUpdated);
        }
        else
            return ApiResponse::fail("update failed :(");
    }
    /**
     * @OA\Delete(
     *     path="/api/cart/item/{item_id}",
     *     tags={"Cart"},
     *     description="Xóa sản phẩm có {item_id} khỏi giỏ hàng",
     *     summary="xóa sản phẩm",
     *     @OA\Parameter (
     *         in="path",
     *         description="item_id trong giỏ hàng",
     *         required=true,
     *         name="item_id"
     *     ),
     *     @OA\Response(response=200, description="Xóa sản phẩm than công"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ")
     * )
     */
    public function destroy(string $item_id) : ApiResponse
    {
        $this->cartService->deleteCartItem(CartItemInputData::validateAndCreate(['cart_item_id' => $item_id]));
        return ApiResponse::success('deleted successfully');
    }
}
