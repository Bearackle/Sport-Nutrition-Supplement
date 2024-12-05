<?php

namespace App\Services\Order;

use App\DTOs\InputData\OrderInputData;
use App\DTOs\InputData\PaymentInputData;
use App\DTOs\OutputData\OrderOutputData;
use App\DTOs\OutputData\PaymentOutputData;
use App\Enum\PaymentMethod;
use App\Enum\PaymentStatus;
use App\Models\Order;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Payment\PaymentRepositoryInterface;
use http\Env\Request;

class PaymentService implements PaymentServiceInterface
{
    protected PaymentRepositoryInterface $paymentRepository;
    protected OrderRepositoryInterface $orderRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->paymentRepository = $paymentRepository;
        $this->orderRepository = $orderRepository;
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
}
