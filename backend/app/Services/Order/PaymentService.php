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
    protected PaymentRepositoryInterface  $paymentRepository;
    protected OrderRepositoryInterface $orderRepository;
    public function __construct(PaymentRepositoryInterface $paymentRepository, OrderRepositoryInterface $orderRepository){
        $this->paymentRepository = $paymentRepository;
        $this->orderRepository  = $orderRepository;
    }
    public function addPaymentMethod(PaymentInputData $payment) : PaymentOutputData
    {
        $payment->payment_status = PaymentStatus::PENDING;
        return PaymentOutputData::from($this->paymentRepository->create($payment->toArray()));
    }
    public function getPayments()
    {
    }

    public function getPayment(OrderInputData $order): PaymentOutputData
    {
        $payment = $this->paymentRepository->getPaymentByOrderID($order->order_id);
        return PaymentOutputData::from($payment);
    }

    public function createPayment(OrderInputData $order, $ip)
    {
        $orderData = $this->orderRepository->find($order->order_id);
        $vnp_TmnCode = config('vnpay.vnp_TmnCode'); // Mã website của bạn tại VNPAY
        $vnp_HashSecret = config('vnpay.vnp_HashSecret'); // Chuỗi bí mật
        $vnp_Url = config('vnpay.vnp_Url'); // URL thanh toán của VNPAY
        $vnp_ReturnUrl = config('vnpay.vnp_Returnurl'); // URL nhận kết quả trả về
        $orderTarget = (object)[
            "code" => 'ORDER' . rand(100000, 999999),  // Mã đơn hàng
            "total" => $orderData->total_amount, // Số tiền cần thanh toán (VND)
            "bankCode" => 'VCB',   // Mã ngân hàng
            "type" => "billpayment", // Loại đơn hàng
             "info" => "Thanh toán đơn hàng", // Thông tin đơn hàng
          ];
        $vnp_TxnRef = $orderTarget->code;
        $vnp_OrderInfo = $orderTarget->info;
        $vnp_OrderType =  $orderTarget->type;
        $vnp_Amount = $orderTarget->total * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = $order->bankCode;  // Mã ngân hàng

    }

}
