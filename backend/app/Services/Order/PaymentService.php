<?php

namespace App\Services\Order;

use App\Enum\PaymentMethod;
use App\Enum\PaymentStatus;
use App\Repositories\Payment\PaymentRepositoryInterface;

class PaymentService implements PaymentServiceInterface
{
    protected PaymentRepositoryInterface  $paymentRepository;
    public function __construct(PaymentRepositoryInterface $paymentRepository){
        $this->paymentRepository = $paymentRepository;
    }
    public function addPaymentMethod(array $data): void
    {
        $data['Status'] = PaymentStatus::PENDING->value;
        $data['PaymentMethod'] = PaymentMethod::equals($data['PaymentMethod'])->value;
        $this->paymentRepository->create($data);
    }
    public function getPayments()
    {

    }

    public function getPayment($order_id)
    {
    }
}
