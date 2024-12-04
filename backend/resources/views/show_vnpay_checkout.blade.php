<!
<html lang="vn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>vnpay</title>
</head>
<body>
    <form method="POST" action="{{url('/payment/vn-pay')}}">
        @csrf
        <button type="submit" class="btn btn-default check-out" name="redirect">Thanh toán VNPAY</button>
    </form>
</body>
</html>
