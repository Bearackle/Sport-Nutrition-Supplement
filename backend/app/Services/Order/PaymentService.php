<?php

namespace App\Services\Order;

use App\DTOs\InputData\OrderInputData;
use App\DTOs\InputData\PaymentInputData;
use App\DTOs\OutputData\OrderOutputData;
use App\DTOs\OutputData\PaymentOutputData;
use App\Enum\OrderStatus;
use App\Enum\PaymentMethod;
use App\Enum\PaymentStatus;
use App\Models\Order;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Services\User\AESCodeServiceInterface;
use Carbon\Carbon;
use http\Env\Request;

class PaymentService implements PaymentServiceInterface
{
    protected PaymentRepositoryInterface $paymentRepository;
    protected OrderRepositoryInterface $orderRepository;
    protected AESCodeServiceInterface $aesCodeService;

    public function __construct(PaymentRepositoryInterface $paymentRepository, OrderRepositoryInterface $orderRepository,
    AESCodeServiceInterface $aesCodeService)
    {
        $this->paymentRepository = $paymentRepository;
        $this->orderRepository = $orderRepository;
        $this->aesCodeService = $aesCodeService;
    }

    public function addPaymentMethod(PaymentInputData $payment): PaymentOutputData
    {
        $payment->payment_status = PaymentStatus::PENDING;
        return PaymentOutputData::from($this->paymentRepository->create($payment->toArray()));
    }

    public function getPayments()
    {
    }

    public function getPaymentData(OrderInputData $order)
    {
        $paymentData = $this->paymentRepository->getPaymentByOrderID($order->order_id);
        return $paymentData;
    }

    public function createPayment(OrderInputData $order)
    {
        $orderData = $this->orderRepository->find($order->order_id);
    }
    public function updateSuccessStatus($orderData,PaymentStatus $paymentStatus): void
    {
        $order = $this->orderRepository->find($orderData['order_id']);
        $order->update(['status' => OrderStatus::SHIPPING->value]);
        $order->payment->update(['payment_status' => $paymentStatus->value]);
    }
    public function getCheckOutUrl($orderId): string
    {
        $data = json_encode(['order_id' => $orderId,
            'ttl' => Carbon::now()->addMinutes(30)->timestamp]);
        $encryptOrderData = $this->aesCodeService->encryptAES($data);
        return route('payment.check-out', ['data' => $encryptOrderData]);
    }
}
