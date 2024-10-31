<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Order\OrderService;
use App\Services\Order\OrderServiceInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected OrderServiceInterface $orderService;
    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }
    /**
     * @OA\Get(
     *     path="/api/order/all/{user_id}",
     *     description="Tất cả đơn hàng của người dùng",
     *     summary="Tìm tất cả đơn hàng",
     *     tags={"Order"},
     *     @OA\Parameter (
     *         name="user_id",
     *         in="path",
     *         description="id của người dùng",
     *     ),
     *     @OA\Response(response=200,description="Lấy đơn hàng thành công"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ")
     * )
     */
    public function index(string $userid)
    {
        return $this->orderService->getOrderofUser($userid);
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
     *              required={"userid"},
     *              @OA\Property (property="userid", type="integer", example=1),
     *              @OA\Property (property="message", type="string", example="goi hang can than")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Tạo đơn hàng thành công"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ")
     * )
     */
    public function store(Request $request): void
    {
        $this->orderService->createOrder($request->userid, $request->message);
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
     *     @OA\Response(response=200, description="Tìm thông tin thành công"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ")
     * )
     */
    public function show(string $order_id)
    {
        return $this->orderService->getOrderData($order_id);
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
     *              @OA\Property (property="Status", description="Trạng thái đơn hàng")
     *         ),
     *     ),
     *     @OA\Response(response=200, description="Cập nhật đơn hàng"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ")
     * )
     */
    public function update(Request $request,string $order_id): void
    {
        $this->orderService->updateOrderStatus($order_id, $request->input('Status'));
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
     *     @OA\Response(response=200, description="Xóa đơn hàng thành công"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ")
     * )
     */
    public function destroy(string $order_id) : void
    {
        $this->orderService->destroyOrder($order_id);
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
     *              required={"OrderID","PaymentMethod"},
     *              @OA\Property(property="OrderID", type="integer", example=17),
     *              @OA\Property (property="PaymentMethod", type="string", example="VN_PAY")
     *          )
     *     ),
     *     @OA\Response(response=200, description="Thêm phương thức thanh toán thành công"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ")
     * )
     */
    public function addPayment(Request $request) : void{
        $this->orderService->addPaymentMethod($request->all());
    }

    /**
     *
     */
    public function addAddress(Request $request) : void{
        $this->orderService->addAddress($request->all());
    }
    public function addShipping(Request $request) : void{
        $this->orderService->addShippingMethod($request->all());
    }
}
