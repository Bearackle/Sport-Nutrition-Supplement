<?php

namespace App\Services\Order;

use App\Enum\OrderStatus;
use App\Http\Responses\ApiResponse;
use App\Models\Order;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Order\OrderDetailRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use Brick\Math\BigInteger;

class OrderService implements OrderServiceInterface
{
    protected OrderRepositoryInterface $order_repository;
    protected OrderDetailRepositoryInterface $order_detail_repository;
    protected CartServiceInterface $cart_service;
    protected CartRepositoryInterface $cart_repository;
    public function __construct(OrderRepositoryInterface $order_repository,
                                OrderDetailRepositoryInterface $order_detail_repository,CartServiceInterface $cart_service, CartRepositoryInterface
                                $cart_repository)
    {
        $this->order_repository = $order_repository;
        $this->order_detail_repository = $order_detail_repository;
        $this->cart_service = $cart_service;
        $this->cart_repository = $cart_repository;
    }
    public function getOrderData($order_id)
    {
        return $this->order_repository->find($order_id);
    }
    public function createOrder($userid, string $message): void
    {
        $cart_id = $this->cart_service->getCart($userid);
        $items = $this->cart_repository->getCartItems($cart_id)->first();
        $total_amount = $this->totalAmount($items->products, $items->combos);
        $new_order_make = ['UserID' => $userid,
            'TotalAmount' => $total_amount,
            'Status' => OrderStatus::PENDING,
            'Note' => $message];
        $new_order = $this->order_repository->create($new_order_make);
        $this->createOrderItems($new_order,$items);
    }
    public function updateOrderStatus($order_id, string $status): void
    {
        $status_data = OrderStatus::equals($status);
        $this->order_repository->update($order_id, ['Status' => $status_data->value]);
    }
    public function destroyOrder($id) : void
    {
        $order = $this->order_repository->find($id);
        $order->products()->detach();
        $order->combos()->detach();
        $this->order_repository->delete($id);
    }
    private function totalAmount($product , $combo) : int {
        $sum = 0;
        foreach( $product as $item){
            $sum += $item['PriceAfterSale'] * $item->pivot->Quantity;
        }
        foreach( $combo as $item){
            $sum+= $item['Cb_PriceAfterSale'] * $item->pivot->Quantity;
        }
        return $sum;
    }
    private function createOrderItems($order,$items) : void{
        foreach($items->products as $product) {
            $order->products()->attach($product->ProductID,
                ['VariantID' => null, 'Quantity' => $product->pivot->Quantity,
                    'UnitPrice' => $product->PriceAfterSale]);
        }
        foreach($items->variants as $variant){
              $order->products()->updateExistingPivot
              ($variant->ProductID,['VariantID' => $variant->VariantID]);
        }
        foreach($items->combos as $combo){
            $order->combos()->attach($combo->ComboID,
                ['UnitPrice' => $combo->PriceAfterSale,'Quantity' => $combo->pivot->Quantity]);
        }
    }
}
