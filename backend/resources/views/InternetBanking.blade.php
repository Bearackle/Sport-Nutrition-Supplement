<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Thanh Toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.webp') }}">
    <style>
        body {
            background-color: #f4f7fc;
            font-family: Arial, sans-serif;
        }
        .payment-container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .qr-code {
            text-align: center;
            border-right: 1px solid #eaeaea;
            padding-right: 20px;
        }
        .qr-code img {
            max-width: 180px;
            margin-bottom: 10px;
        }
        .info {
            padding-left: 20px;
        }
        .info .title {
            font-weight: 500;
            color: #666;
        }
        .info .value {
            font-size: 1.1rem;
            font-weight: bold;
            color: #1a73e8;
        }
        .countdown {
            text-align: right;
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }
        .btn-cancel {
            margin-top: 30px;
            background-color: #e0e7ff;
            color: #1a73e8;
            border: none;
        }
        .btn-cancel:hover {
            background-color: #c7d2fe;
        }
        .info .d-flex {
            margin-bottom: 17px; /* Tạo khoảng cách giữa các dòng */
        }
    </style>
</head>
<body>

<div class="payment-container">

    <h4 class="text-center">Thông tin chuyển khoản</h4>

    <div class="row">
        <div class="col-md-6 qr-code">
            <p>Quét mã qua <strong>Ứng dụng Ngân hàng hoặc Ví điện tử</strong></p>
            <img src="{{asset('qr.png')}}" alt="QR Code">
        </div>
        <div class="col-md-6 info">
            <div class="d-flex justify-content-between">
                <span class="title">Số tiền:</span>
                <span class="value">{{$payment->order->total_amount}} VNĐ</span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="title">Ngân hàng:</span>
                <span class="value">VIETCOMBANK</span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="title">Số tài khoản:</span>
                <span class="value">1021184195</span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="title">Chủ tài khoản:</span>
                <span class="value">TRAN DUY HUNG</span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="title">Nội dung giao dịch:</span>
                <span class="value">#HD{{$payment->order->order_id}}</span>
            </div>
        </div>
    </div>
    <button onclick="window.location.href='{{ route('payment.success',['data' => $data]) }}'" class="btn btn-cancel w-100 fw-bold">Hoàn thành</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
