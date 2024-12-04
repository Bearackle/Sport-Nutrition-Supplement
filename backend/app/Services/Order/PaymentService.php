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

    public function getPayment(OrderInputData $order): PaymentOutputData
    {
        $payment = $this->paymentRepository->getPaymentByOrderID($order->order_id);
        return PaymentOutputData::from($payment);
    }

    public function createPayment(OrderInputData $order)
    {
        $orderData = $this->orderRepository->find($order->order_id);
    }
    public function VNPAY(OrderInputData $order){
             $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
             $vnp_Returnurl = "http://localhost:8000/payment/check-out";
             $vnp_TmnCode = "YHR1DK4Y";//Mã website tại VNPAY
             $vnp_HashSecret = "3NSOGGL258PLOFC4KDPAVK4AK64TTWM2"; //Chuỗi bí mật
             $vnp_TxnRef = '1234';
             $vnp_OrderInfo = 'Thanh toán đơn hàng';
             $vnp_OrderType = 'billpayment';
             $vnp_Amount = $amount * 100;
             $vnp_Locale = 'vn';
             $vnp_BankCode = 'NCB';
             $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
             $inputData = array(
                 "vnp_Version" => "2.1.0",
                 "vnp_TmnCode" => $vnp_TmnCode,
                 "vnp_Amount" => $vnp_Amount,
                 "vnp_Command" => "pay",
                 "vnp_CreateDate" => date('YmdHis'),
                 "vnp_CurrCode" => "VND",
                 "vnp_IpAddr" => $vnp_IpAddr,
                 "vnp_Locale" => $vnp_Locale,
                 "vnp_OrderInfo" => $vnp_OrderInfo,
                 "vnp_OrderType" => $vnp_OrderType,
                 "vnp_ReturnUrl" => $vnp_Returnurl,
                 "vnp_TxnRef" => $vnp_TxnRef,
             );
             if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                 $inputData['vnp_BankCode'] = $vnp_BankCode;
             }

            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                json_encode($returnData);
            }
    }
}
