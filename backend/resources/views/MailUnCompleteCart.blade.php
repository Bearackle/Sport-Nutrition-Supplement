<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <style>
body {
    font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container {
    max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .logo {
    text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
    max-width: 150px;
        }
        .header {
    text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
    margin: 0;
}
.order-details {
    margin-top: 20px;
        }
        .order-details table {
    width: 100%;
    border-collapse: collapse;
        }
        .order-details th, .order-details td {
    border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .order-details th {
    background-color: #f4f4f4;
        }
        .actions {
    margin-top: 20px;
            text-align: center;
        }
        .actions a {
    text-decoration: none;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            margin: 5px;
        }
        .actions a:hover {
    background-color: #218838;
        }
        .footer {
    margin-top: 20px;
            font-size: 14px;
            text-align: center;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('logo.webp') }}" alt="Logo">
        </div>
            {{ $user->name}}
        <div class="header">
            <p>Chào ,</p>
<p>Chúng tôi nhận thấy có một số mặt hàng được đặt trong giỏ hàng của bạn. Nếu bạn đã sẵn sàng để mua hàng, vui lòng quay trở lại với chúng tôi để hoàn thành việc thanh toán.</p>
</div>
<div class="actions">
    <a href="4hprotein.vercel.app">Hoàn thành đơn hàng</a>
</div>
<div class="order-details">
    <h3>Thông tin đơn hàng</h3>
    <table>
        <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
        </tr>
        </thead>
        <tbody>
        @foreach ( $data['products'] as $item)
            <tr>
                <td>{{ $item['product_name'] }}</td>
                <td>{{ number_format($item['priceAfterSale'], 0, ',', '.') }} VND</td>
                <td>{{ $item['quantity'] }}</td>
            </tr>
        @endforeach
        @foreach ( $data['combos'] as $item)
            <tr>
                <td>{{ $item['combo_name'] }}</td>
                <td>{{ number_format($item['priceAfterSale'], 0, ',', '.') }} VND</td>
                <td>{{ $item['quantity'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="footer">
    <p>Nếu bạn có bất kỳ câu hỏi nào, xin liên hệ với chúng tôi tại <a href="mailto:hzprotein.supplement@gmail.com">hzprotein.supplement@gmail.com</a></p>
</div>
</div>
</body>
</html>
