<?php

namespace App\Http\Controllers\Api;

use App\DTOs\InputData\AddressInputData;
use App\DTOs\InputData\OrderInputData;
use App\DTOs\InputData\PaymentInputData;
use App\DTOs\InputData\ShippingMethodInputData;
use App\DTOs\InputData\UserInputData;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PaymentResource;
use App\Http\Responses\ApiResponse;
use App\Models\Order;
use App\Models\User;
use App\Services\Order\OrderServiceInterface;
use App\Services\Order\PaymentServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Arr;

class OrderController extends Controller
{
    use AuthorizesRequests;
    protected OrderServiceInterface $orderService;
    protected PaymentServiceInterface $paymentService;
    public function __construct(OrderServiceInterface $orderService, PaymentServiceInterface $paymentService)
    {
        $this->orderService = $orderService;
        $this->paymentService = $paymentService;
    }
    /**
     * @OA\Get(
     *     path="/api/order/all",
     *     description="Tất cả đơn hàng của người dùng",
     *     summary="Tìm tất cả đơn hàng",
     *     tags={"Order"},
     *     @OA\Response(response=200,description="Lấy đơn hàng thành công",@OA\JsonContent()),
     *     @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     * @throws AuthorizationException
     */
    public function index(): AnonymousResourceCollection
    {
        $this->authorize('view', Order::class);
        /**@var User $user**/
        $user = auth()->user();
        $orders = $this->orderService->getOrderofUser(UserInputData::validateAndCreate(['user_id' => $user->user_id]));
        return OrderResource::collection($orders);
    }
    /**
     * @OA\Get(
     *     path="/api/order/admin/all",
     *     description="Tất cả đơn hàng của đang tồn tại trong hệ thống, sắp xếp theo ngày tạo mới nhất",
     *     summary="Tìm tất cả đơn hàng",
     *     tags={"Order"},
     *     @OA\Response(response=200,description="Lấy đơn hàng thành công",@OA\JsonContent()),
     *     @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     * @throws AuthorizationException
     */
    public function adminGetOrders(): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Order::class);
        $orders = $this->orderService->getAllOrders();
        return OrderResource::collection($orders);
    }
    /**
     * @OA\Post(
     *     path="/api/order/create",
     *     description="Tạo đơn hàng từ giỏ hàng của người dùng",
     *     tags={"Order"},
     *     summary="Tạo đơn hàng",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *              @OA\Property (property="message", type="string", example="goi hang can than")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Tạo đơn hàng thành công",@OA\JsonContent()),
     *     @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     * @throws AuthorizationException
     */
    public function store(Request $request): OrderResource
    {
        $this->authorize('create', Order::class);
        /**@var User $user**/
        $user = auth()->user();
        $order = $this->orderService->createOrder(
            UserInputData::validateAndCreate(['user_id' => $user->user_id]),$request->input('message'));
        return new OrderResource($order);
    }
    /**
     * @OA\Get(
     *     path="/api/order/{order_id}",
     *     description="Tìm thông tin đơn hàng có {order_id}",
     *     tags={"Order"},
     *     summary="Tìm thông tin đơn hàng",
     *     @OA\Parameter (
     *         name="order_id",
     *         in="path",
     *         description="nhập order_id của đơn hàng"
     *     ),
     *     @OA\Response(response=200, description="Tìm thông tin thành công",@OA\JsonContent()),
     *     @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     * @throws AuthorizationException
     */
    public function show(string $order_id): OrderResource
    {
        $this->authorize('view', Order::class);
        $order =  $this->orderService->getOrderData(OrderInputData::validateAndCreate(['order_id' => $order_id]));
        return new OrderResource($order);
    }
    /**
     * @OA\Patch(
     *     path="/api/order/status/{order_id}",
     *     description="Cập nhật trạng thái của đơn hàng có {order_id}",
     *     tags={"Order"},
     *     summary="Trạng thái đơn hàng",
     *     @OA\Parameter (
     *         name="order_id",
     *         in="path",
     *         description="Nhập order_id",
     *         required=true
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property (property="status", description="Trạng thái đơn hàng",example="SHIPPED")
     *         ),
     *     ),
     *     @OA\Response(response=200, description="Cập nhật đơn hàng",@OA\JsonContent()),
     *     @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     * @throws AuthorizationException
     */
    public function update(Request $request,string $order_id)  : OrderResource
    {
        $this->authorize('update', Order::class);
        $order = OrderInputData::factory()->alwaysValidate()->from(['order_id' => $order_id],$request->input());
        $orderUpdated = $this->orderService->updateOrder($order);
        return new OrderResource($orderUpdated);
    }
    /**
     * @OA\Delete(
     *     path="/api/order/{order_id}",
     *     description="Xóa đơn hàng có order_id",
     *     tags={"Order"},
     *     summary="Xóa đơn hàng",
     *     @OA\Parameter (
     *         name="order_id",
     *         in="path",
     *         required=true,
     *         description="Nhập order_id",
     *     ),
     *     @OA\Response(response=200, description="Xóa đơn hàng thành công",@OA\JsonContent()),
     *     @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     * @throws AuthorizationException
     */
    public function destroy(string $order_id): \Illuminate\Http\JsonResponse
    {
        $this->authorize('delete', Order::class);
        $this->orderService->destroyOrder(OrderInputData::validateAndCreate(['order_id' => $order_id]));
        return ApiResponse::success('delete order successful');
    }
    /**
     * @OA\Post(
     *     path="/api/order/payment",
     *     summary="Phương thức thanh toán",
     *     description="Thêm phương thức thanh toán",
     *     tags={"Order"},
     *     @OA\RequestBody(
     *         required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              required={"orderId","paymentMethod"},
     *              @OA\Property(property="orderId", type="integer", example=1),
     *              @OA\Property (property="paymentMethod", type="string", example="VN_PAY")
     *          )
     *     ),
     *     @OA\Response(response=200, description="Thêm phương thức thanh toán thành công",@OA\JsonContent()),
     *     @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     * @throws AuthorizationException
     */
    public function addPayment(Request $request): PaymentResource
    {
        $this->authorize('create' , Order::class);
        $orderPayment = PaymentInputData::validateAndCreate(['order_id' => $request->input('orderId'),
            'payment_method' => $request->input('paymentMethod')]);
        $payment = $this->orderService->addPaymentMethod($orderPayment);
        return new PaymentResource($payment);
    }

    /**
     * @throws AuthorizationException
     * @OA\Get(
     *    path="/api/order/payment/{order_id}",
     *    tags={"Order"},
     *    summary="Thông tin thanh toán",
     *    description="Tìm thông tin thanh toán của người dùng",
     *    @OA\Parameter (
     *        in="path",
     *        name="order_id",
     *        required=true,
     *        description="mã đơn hàng",
     *    ),
     *    @OA\Response(response=200, description="Tìm thành công",@OA\JsonContent()),
     *    @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     */
    public function getOrderPayments(string $orderId): PaymentResource
    {
        $this->authorize('view', Order::class);
        $payment = $this->paymentService->getPayment(OrderInputData::validateAndCreate(['order_id' => $orderId]));
        return new PaymentResource($payment);
    }
    /**
     * @OA\Post(
     *     path="/api/order/address",
     *     summary="Thêm địa chỉ",
     *     tags={"Order"},
     *     description="Thêm địa chỉ cho ơn hàng",
     *     @OA\RequestBody(
     *          required=true,
     *           @OA\JsonContent(
     *               type="object",
     *               required={"orderId","addressDetail"},
     *               @OA\Property(property="orderId", type="integer", example=1),
     *               @OA\Property (property="addressDetail", type="string", example="so 1...")
     *           )
     *      ),
     *     @OA\Response(response=200, description="Thêm địa chỉ thành công",@OA\JsonContent()),
     *     @OA\Response(response=400, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     * @throws AuthorizationException
     */
    public function addAddress(Request $request) : OrderResource
    {
        $this->authorize('create', Order::class);
        $order = $this->orderService->addAddress(OrderInputData::validateAndCreate(['order_id' => $request->input('orderId')]),
        AddressInputData::validateAndCreate(Arr::except($request->input(),['orderId'])));
        return new OrderResource($order);
    }

    /**
     * @param Request $request
     * @return OrderResource
     * @throws AuthorizationException
     * @OA\Post(
     *     path="/api/order/ship",
     *     tags={"Order"},
     *     description="Thêm phuơng thức vận chuyển cho đơn hàng",
     *     summary="Thêm phương thức vận chuyển",
     * @OA\RequestBody(
     *           required=true,
     *            @OA\JsonContent(
     *                type="object",
     *                required={"orderId","method"},
     *                @OA\Property(property="orderId", type="integer", example=1),
     *                @OA\Property (property="method", type="string", example="VN")
     *            )
     *       ),
     * @OA\Response(response=200, description="Thêm thành công",@OA\JsonContent()),
     * @OA\Response (response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     */
    public function addShipping(Request $request) : OrderResource
    {
        $this->authorize('create', Order::class);
        $order = $this->orderService->addShippingMethod(OrderInputData::validateAndCreate(['order_id' => $request->input('orderId')])
        ,ShippingMethodInputData::from(Arr::except($request->input(),['orderId'])));
         return new OrderResource($order);
    }
}
