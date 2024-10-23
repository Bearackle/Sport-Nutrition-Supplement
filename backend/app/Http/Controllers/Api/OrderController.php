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
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->orderService->getOrderofUser($request->userid);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        $this->orderService->createOrder($request->userid, $request->message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $order_id)
    {
        return $this->orderService->destroyOrder($order_id);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): void
    {
        $this->orderService->updateOrderStatus($request->OrderID, $request->Status);
    }

    /**s
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request) : void
    {
        $this->orderService->destroyOrder($request->id);
    }
    public function addPayment(Request $request) : void{
        $this->orderService->addPaymentMethod($request->all());
    }
    public function addAddress(Request $request) : void{
        $this->orderService->addAddress($request->all());
    }
    public function addShipping(Request $request) : void{
        $this->orderService->addShippingMethod($request->all());
    }
}
