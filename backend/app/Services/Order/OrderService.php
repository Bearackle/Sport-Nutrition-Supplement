<?php

namespace App\Services\Order;

use App\DTOs\InputData\AddressInputData;
use App\DTOs\InputData\OrderInputData;
use App\DTOs\InputData\PaymentInputData;
use App\DTOs\InputData\ShippingMethodInputData;
use App\DTOs\InputData\UserInputData;
use App\DTOs\OutputData\OrderOutputData;
use App\DTOs\OutputData\PaymentOutputData;
use App\Enum\OrderStatus;
use App\Enum\ShipMethod;
use App\Events\addShippingCharges;
use App\Models\Address;
use App\Repositories\Address\AddressRepositoryInterface;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Order\OrderDetailRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Services\Address\AddressServiceInterface;

class OrderService implements OrderServiceInterface
{
    protected OrderRepositoryInterface $order_repository;
    protected OrderDetailRepositoryInterface $order_detail_repository;
    protected CartServiceInterface $cart_service;
    protected CartRepositoryInterface $cart_repository;
    protected PaymentServiceInterface $payment_service;
    protected AddressRepositoryInterface $address_repository;
    protected AddressServiceInterface $address_service;

    public function __construct(OrderRepositoryInterface $order_repository,
                                OrderDetailRepositoryInterface $order_detail_repository,CartServiceInterface $cart_service, CartRepositoryInterface
                                $cart_repository, PaymentServiceInterface $payment_service, AddressRepositoryInterface $address_repository,
    AddressServiceInterface $address_service)
    {
        $this->order_repository = $order_repository;
        $this->order_detail_repository = $order_detail_repository;
        $this->cart_service = $cart_service;
        $this->cart_repository = $cart_repository;
        $this->payment_service = $payment_service;
        $this->address_repository = $address_repository;
        $this->address_service  = $address_service;
    }
    public function getOrderData(OrderInputData $order) : OrderOutputData
    {
        return OrderOutputData::from($this->order_repository->find($order->order_id));
    }
    public function createOrder(UserInputData $user, string $message) : OrderOutputData
    {
        $cart = $this->cart_service->getCart($user);
        $items = $this->cart_repository->getCartItems($cart->cart_id);
        $total_amount = $this->totalAmount($items->variants, $items->combos);
        $new_order_make = ['user_id' => $user->user_id,
            'total_amount' => $total_amount,
            'status' => OrderStatus::PENDING,
            'note' => $message];
        $new_order = $this->order_repository->create($new_order_make);
        $this->createOrderItems($new_order,$items);
        return OrderOutputData::from($new_order);
    }
    public function updateOrder(OrderInputData $order): OrderOutputData| false
    {
        $orderUpdated = $this->order_repository->update($order->order_id, $order->toArray());
        if(!$orderUpdated){
            return false;
        }
        return OrderOutputData::from($orderUpdated);
    }
    public function destroyOrder(OrderInputData $order) : void
    {
        $order = $this->order_repository->find($order->order_id);
        $order->products()->detach();
        $order->combos()->detach();
        $order->delete();
    }
    private function totalAmount($products , $combo) : int
    {
        $sum = 0;
        foreach( $products as $item){
            $sum += $item->product->price_after_sale * $item->pivot->quantity;
        }
        foreach( $combo as $item){
            $sum+= $item->combo_price_after_sale * $item->pivot->quantity;
        }
        return $sum;
    }
    private function createOrderItems($order,$items) : void
    {
        foreach($items->products as $product) {
            $order->products()->attach($product->product_id,
                ['variant_id' => null,
                    'quantity' => $product->pivot->quantity,
                    'unit_price' => $product->price_after_sale]);
        }
        foreach($items->variants as $variant){
              $order->products()->updateExistingPivot
              ($variant->product_id,['variant_id' => $variant->variant_id]);
        }
        foreach($items->combos as $combo){
            $order->combos()->attach($combo->combo_id,
                ['unit_price' => $combo->combo_price_after_sale,'quantity' => $combo->pivot->quantity]);
        }
    }
    public function getOrderofUser(UserInputData $user): \Illuminate\Contracts\Pagination\Paginator|\Illuminate\Support\Enumerable|array|\Illuminate\Support\Collection|\Illuminate\Support\LazyCollection|\Spatie\LaravelData\PaginatedDataCollection|\Illuminate\Pagination\AbstractCursorPaginator|\Spatie\LaravelData\CursorPaginatedDataCollection|\Spatie\LaravelData\DataCollection|\Illuminate\Pagination\AbstractPaginator|\Illuminate\Contracts\Pagination\CursorPaginator
    {
        $orders = $this->order_repository->getAllOrdersByUserID($user->user_id);
        return OrderOutputData::collect($orders);
    }
    public function addAddress(OrderInputData $order,AddressInputData $address) : OrderOutputData
    {
        if($address->has('address_id')){
            $addressData = $this->address_service->getAddressDetail($address)->address_detail;
        } else {
            $addressData = $address->address_detail;
        }
        return OrderOutputData::from($this->order_repository->update($order->order_id,['address_detail' => $addressData]));
    }
    public function addPaymentMethod(PaymentInputData $payment): PaymentOutputData
    {
        return $this->payment_service->addPaymentMethod($payment);
    }
    public function addShippingMethod(OrderInputData $order, ShippingMethodInputData $ship): OrderOutputData
    {
        $order = $this->order_repository->update($order->order_id,['shipment_charges' => $ship->method->value]);
        event(new addShippingCharges($this->order_repository->find($order->order_id), $ship->method));
        return OrderOutputData::from($order);
    }
}
