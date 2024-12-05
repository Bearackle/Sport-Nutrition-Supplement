<!DOCTYPE html>
<html>
<head>
    <title>Subscribe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .custom-alert {
            background-color: #d4edda; /* Màu xanh nhạt */
            color: #155724; /* Màu chữ */
            padding: 10px 15px;
            border-radius: 5px;
            border: 1px solid #c3e6cb; /* Đường viền */
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 50px;
        }
        .form-control {
            width: 300px; /* Đặt chiều rộng cố định */
            margin: auto;
        }
    </style>
</head>
<body class="vh-100">
<div class="container h-100 d-flex justify-content-center align-items-center">
    <form action="{{url('payment/vn-pay')}}" method="post" id="payment-form" style="min-width: 300px;">
        <div class="container mt-5">
            <div class="custom-alert">
                Xin vui lòng kiểm tra kĩ đơn hàng trước khi xác
                nhận thanh toán. Nếu khách hàng muốn huỷ đơn, xin liên hệ qua mail 4hprotein@gmail.com hoặc qua Zalo/SĐT: ... Trễ nhất sau khi thanh toán 6h!!!
                4HProtein xin cảm ơn~
            </div>
        </div>
        @csrf
        <div class="form-group">
            <label for="card-holder-name" class="label">Số tiền cần thanh toán</label>
            <input id="card-holder-name" type="text" class="form-control text-sm" readonly value="{{$payment->order->total_amount}} VNĐ">
        </div>
        <div class="form-group mt-3" >
            <label>Phương thức thanh toán</label>
            <input id="card-holder-name" type="text" class="form-control text-sm" readonly value="{{\App\Enum\PaymentMethod::tryFrom($payment->payment_method)->name}}">
        </div>
        <input type="hidden" name="orderId" value="{{$payment->order->order_id}}">
        <button type="submit" id="card-button" class="btn btn-primary mt-4">Xác nhận</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>
