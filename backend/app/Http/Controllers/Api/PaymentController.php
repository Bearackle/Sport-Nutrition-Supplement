<?php

namespace App\Http\Controllers\Api;

use App\DTOs\InputData\OrderInputData;
use App\DTOs\OutputData\OrderOutputData;
use App\Enum\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Mail\MailPaymentComplelete;
use App\Models\Payment;
use App\Models\User;
use App\Services\Order\PaymentService;
use App\Services\Order\PaymentServiceInterface;
use App\Services\User\AESCodeServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected PaymentServiceInterface $paymentService;
    protected AESCodeServiceInterface $aesCodeService;

    public function __construct(PaymentServiceInterface $paymentService, AESCodeServiceInterface $aesCodeService)
    {
        $this->paymentService = $paymentService;
        $this->aesCodeService = $aesCodeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        $order = OrderInputData::validateAndCreate(['order_id' => $request->get('orderId')]);
        $this->paymentService->createPayment($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function vnpayPayment(Request $request): void
    {
        $payment = $this->paymentService->getPaymentData(OrderInputData::validateAndCreate(['order_id' => $request->input('orderId')]));
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "https://dinhhuan.id.vn/payment/success/".$request->input('data');
        $vnp_TmnCode = "YHR1DK4Y";//Mã website tại VNPAY
        $vnp_HashSecret = "3NSOGGL258PLOFC4KDPAVK4AK64TTWM2"; //Chuỗi bí mật
        $vnp_TxnRef = '#HD'.$request->input('orderId');
        $vnp_OrderInfo = 'Thanh toán đơn hàng';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $payment->order->total_amount * 100;
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
//    public function momoPayment(Request $request){
//        $payment = $this->paymentService->getPaymentData(OrderInputData::validateAndCreate(['order_id' => $request->input('orderId')]));
//        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
//        $partnerCode = 'MOMOBKUN20180529';
//        $accessKey = 'klm05TvNBzhg7h7j';
//        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
//        $orderInfo = "Thanh toán qua MoMo";
//        $amount = $payment->order->total_amount;
//        $orderId = time() ."";
//        $redirectUrl = "http://localhost:8000/payment/success";
//        $ipnUrl = "http://localhost:8000/payment/success";
//        $extraData = "";
//
////            $partnerCode = $_POST["partnerCode"];
////            $accessKey = $_POST["accessKey"];
////            $serectkey = $_POST["secretKey"];
////            $orderId = $_POST["orderId"]; // Mã đơn hàng
////            $orderInfo = $_POST["orderInfo"];
////            $amount = $_POST["amount"];
////            $ipnUrl = $_POST["ipnUrl"];
////            $redirectUrl = $_POST["redirectUrl"];
////            $extraData = $_POST["extraData"];
//
//            $requestId = time() . "";
//            $requestType = "payWithATM";
//            //before sign HMAC SHA256 signature
//            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
//            $signature = hash_hmac("sha256", $rawHash, $secretKey);
//            $data = array('partnerCode' => $partnerCode,
//                'partnerName' => "Test",
//                "storeId" => "MomoTestStore",
//                'requestId' => $requestId,
//                'amount' => $amount,
//                'orderId' => $orderId,
//                'orderInfo' => $orderInfo,
//                'redirectUrl' => $redirectUrl,
//                'ipnUrl' => $ipnUrl,
//                'lang' => 'vi',
//                'extraData' => $extraData,
//                'requestType' => $requestType,
//                'signature' => $signature);
//            $result = $this->execPostRequest($endpoint, json_encode($data));
//            $jsonResult = json_decode($result, true);  // decode json
//
//            //Just a example, please check more in there
//      return redirect()->to($jsonResult['payUrl']);
//     //       header('Location: ' . $jsonResult['payUrl']);
//    }
    public function momoQr(Request $request){
        $payment = $this->paymentService->getPaymentData(OrderInputData::validateAndCreate(['order_id' => $request->input('orderId')]));
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $payment->order->total_amount;
        $orderId = time() ."";
        $redirectUrl = "https://dinhhuan.id.vn/payment/success/".$request->input('data');
        $ipnUrl = "https://dinhhuan.id.vn/payment/success/".$request->input('data');
        $extraData = "";

            $requestId = time() . "";
            $requestType = "payWithATM";
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array('partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature);
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json

            //Just a example, please check more in there
            return redirect()->to($jsonResult['payUrl']);
//            header('Location: ' . $jsonResult['payUrl']);
    }
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function checkOut(string $data): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $orderData = json_decode($this->aesCodeService->decryptAES($data),true);
        if(!$orderData)
        {
            abort(404);
        }
        if((Carbon::now()->timestamp - $orderData['ttl']) >= 0){
            abort(403,'Hết thời gian truy cập');
        }
        $payment = $this->paymentService->getPaymentData(OrderInputData::validateAndCreate(['order_id' => $orderData['order_id']]));
        return view('ConfirmPayment', ['payment' => $payment,'data' => $data]);
    }
    /**
    *@OA\Get(
     *  path="/payment/success/{id}",
     *  description="Thanh toán thành công",
     *  summary="Thanh toán thành công",
     *  tags={"Payment"},
     * @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="id của order",
     *          @OA\Schema(type="integer"),
     *      ),
     * @OA\Response(response=200, description="Success",@OA\JsonContent()),
     * @OA\Response(response=400,description="Fail to get",@OA\JsonContent()),
     * @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     * )
 **/
    public function success(string $data): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $orderData = json_decode($this->aesCodeService->decryptAES($data),true);
        $this->paymentService->updateSuccessStatus($orderData,PaymentStatus::PAID);
        $this->sendMail($orderData['order_id']);
        return view('SuccessPayment');
    }
    public function sendMail(string $orderId): void
    {
        $payment = $this->paymentService->getPaymentData(OrderInputData::validateAndCreate(['order_id' => $orderId]));
        $user = $payment->order->user;
        SendEmail::dispatch($user,$payment);
    }
    /**
     *@OA\Post(
     *  path="/api/payment/check-out-url/{id}",
     *  description="Lấy url thanh toán",
     *  summary="Lấy url thanh toán",
     *  tags={"Payment"},
        @OA\RequestBody(
        required=true,
        @OA\JsonContent(
        type="object",
        required={"orderId","method"},
        @OA\Property(property="orderId", type="integer", example=1),
        )
    ),
     * @OA\Response(response=200, description="Success",@OA\JsonContent()),
     * @OA\Response(response=400,description="Fail to get",@OA\JsonContent()),
     * @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     * )
     **/
    public function getUrlPayment(Request $request): \Illuminate\Http\JsonResponse
    {
        $order = OrderInputData::validateAndCreate(['order_id' => $request->input('orderId')]);
        $data = json_encode(['order_id' => $order->order_id,
            'ttl' => Carbon::now()->addMinutes(30)->timestamp]);
        $encryptOrderData = $this->aesCodeService->encryptAES($data);
        return response()->json([
            'redirectUrl' => route('payment.check-out', ['data' => $encryptOrderData])
        ]);
    }
    public function internetBanking(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $payment = $this->paymentService->getPaymentData(OrderInputData::validateAndCreate(['order_id' => $request->input('orderId')]));
        $this->paymentService->updateSuccessStatus($request->input('orderId'),PaymentStatus::PENDING);
        return view('InternetBanking',['payment' => $payment,'data' => $request->input('data')]);
    }
    public function codPayment(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $this->sendMail($request->input('orderId'));
        $this->paymentService->updateSuccessStatus(['order_id' => $request->input('orderId')],PaymentStatus::PENDING);
        return view('SuccessOrdered');
    }
}

