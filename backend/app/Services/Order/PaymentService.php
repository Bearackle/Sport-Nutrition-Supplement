<?php

namespace App\Services\Order;

use App\DTOs\InputData\OrderInputData;
use App\DTOs\InputData\PaymentInputData;
use App\Enum\PaymentMethod;
use App\Enum\PaymentStatus;
use App\Repositories\Payment\PaymentRepositoryInterface;

class PaymentService implements PaymentServiceInterface
{
    protected PaymentRepositoryInterface  $paymentRepository;
    public function __construct(PaymentRepositoryInterface $paymentRepository){
        $this->paymentRepository = $paymentRepository;
    }
    public function addPaymentMethod(PaymentInputData $payment): void
    {
        $payment->payment_status = PaymentStatus::PENDING;
        $this->paymentRepository->create($payment->toArray());
    }
    public function getPayments()
    {

    }

    public function getPayment(OrderInputData $order)
    {
    }
}
