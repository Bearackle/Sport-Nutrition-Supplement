<?php

namespace App\Services\Order;

use App\DTOs\InputData\AddressInputData;
use App\DTOs\InputData\OrderInputData;
use App\DTOs\InputData\PaymentInputData;
use App\DTOs\InputData\ShippingMethodInputData;
use App\DTOs\InputData\ShoppingCartInputData;
use App\DTOs\InputData\UserInputData;
use App\DTOs\OutputData\OrderOutputData;
use App\DTOs\OutputData\PaymentOutputData;
use App\Enum\OrderStatus;
use App\Enum\PaymentMethod;
use App\Enum\ShipMethod;
use App\Events\addShippingCharges;
use App\Jobs\OrderStockQuantity;
use App\Models\Address;
use App\Repositories\Address\AddressRepositoryInterface;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Order\OrderDetailRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Product\ProductVariantRepositoryInterface;
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
    protected ProductVariantRepositoryInterface $product_variant_repository;

    public function __construct(OrderRepositoryInterface $order_repository,
                                OrderDetailRepositoryInterface $order_detail_repository,CartServiceInterface $cart_service, CartRepositoryInterface
                                $cart_repository, PaymentServiceInterface $payment_service, AddressRepositoryInterface $address_repository,
    AddressServiceInterface $address_service,ProductVariantRepositoryInterface $product_variant_repository)
    {
        $this->order_repository = $order_repository;
        $this->order_detail_repository = $order_detail_repository;
        $this->cart_service = $cart_service;
        $this->cart_repository = $cart_repository;
        $this->payment_service = $payment_service;
        $this->address_repository = $address_repository;
        $this->address_service  = $address_service;
        $this->product_variant_repository= $product_variant_repository;
    }
    public function getOrderData(OrderInputData $order)
    {
        $data = $this->order_repository->getOrderWithProducts($order->order_id);
        return $data;
    }
    public function createOrder(UserInputData $user)
    {
        $cart = $this->cart_service->getCart($user);
        $items = $this->cart_repository->getCartItems($cart->cart_id);
        $total_amount = $this->totalAmount($items->variants, $items->combos);
        $new_order_make = ['user_id' => $user->user_id,
            'total_amount' => $total_amount,
            'status' => OrderStatus::PENDING,
            ];
        $new_order = $this->order_repository->create($new_order_make);
        $this->decreaseQuantity($items,$new_order);
        $this->createOrderItems($new_order,$items);
        $data = $this->order_repository->getOrderWithProducts($new_order->order_id);
        return $data;
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
    public function getOrderofUser(UserInputData $user)
    {
        $orders = $this->order_repository->getAllOrdersByUserID($user->user_id);
        return $orders;
    }
    public function addAddress(OrderInputData $order,AddressInputData $address) : OrderOutputData
    {
        if($address->address_id != null) {
            $addressData = $this->address_service->getAddressDetail($address)->address_detail;
        } else {
            $addressData = $address->address_detail;
            $this->address_service->createAddress(AddressInputData::from(['order_id' => $order->order_id,
                'user_id' => $order->user_id,
                'address_detail' => $addressData]));
        }
        return OrderOutputData::from($this->order_repository->update($order->order_id,['address_detail' => $addressData]));
    }
    public function addPaymentMethod(PaymentInputData $payment): PaymentOutputData
    {
        return PaymentOutputData::from($this->payment_service->addPaymentMethod($payment));
    }
    public function addShippingMethod(OrderInputData $order, ShippingMethodInputData $ship): OrderOutputData
    {
        $order = $this->order_repository->update($order->order_id,['shipment_charges' => $ship->method->value]);
        event(new addShippingCharges($this->order_repository->find($order->order_id), $ship->method));
        return OrderOutputData::from($order);
    }
    public function getAllOrders(): \Illuminate\Contracts\Pagination\Paginator|\Illuminate\Support\Enumerable|array|\Illuminate\Support\Collection|\Illuminate\Support\LazyCollection|\Spatie\LaravelData\PaginatedDataCollection|\Illuminate\Pagination\AbstractCursorPaginator|\Spatie\LaravelData\CursorPaginatedDataCollection|\Spatie\LaravelData\DataCollection|\Illuminate\Pagination\AbstractPaginator|\Illuminate\Contracts\Pagination\CursorPaginator
    {
        return OrderOutputData::collect($this->order_repository->getAllOrders()->paginate(10));
    }

    public function checkItemsQuantity(UserInputData $user)
    {
        $cart = $this->cart_service->getCart($user);
        return $this->cart_service->checkCartItemsVersion(ShoppingCartInputData::from($cart));
    }
    public function decreaseQuantity($items,$order): void
    {
        $data = [];
        foreach($items->variants as $item){
            $data[$item->variant_id] = $item->pivot->quantity;
            $variant = $this->product_variant_repository->find($item->variant_id);
            $variant->update(['stock_quantity' => $variant->stock_quantity - $item->pivot->quantity]);
            $product = $variant->product;
            $product->update(['stock_quantity' => $product->stock_quantity - $item->pivot->quantity]);
        }
        OrderStockQuantity::dispatch($data,$order,$this->order_repository)->delay(30*60);
    }
}
