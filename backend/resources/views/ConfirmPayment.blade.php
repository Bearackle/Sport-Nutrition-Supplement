<!DOCTYPE html>
<html>
<head>
    <title>Subscribe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="vh-100">
<div class="container h-100 d-flex justify-content-center align-items-center">
    <form action="{{url('payment/vn-pay')}}" method="post" id="payment-form" style="min-width: 300px;">
        @csrf
        <div class="form-group">
            <label for="card-holder-name" class="label">Số tiền cần thanh toán</label>
            <input id="card-holder-name" type="text" class="form-control text-sm" readonly value="1000">
        </div>
        <div class="form-group mt-3">
            <label>Phương thức thanh toán</label>
            <input id="card-holder-name" type="text" class="form-control text-sm" readonly value="1000">
        </div>
        <button type="submit" id="card-button" class="btn btn-primary mt-4">Xác nhận</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>
