<!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận thanh toán</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .email-container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .header img {
            max-width: 150px;
        }
        .content {
            padding: 20px 0;
        }
        .content h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .content p {
            margin: 5px 0;
        }
        .info-section {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .info-box {
            width: 48%;
        }
        .info-box h3 {
            font-size: 18px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .info-box p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }
        .highlight {
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>
<div class="email-container">
    <!-- Header Section -->
    <div class="header">
        <img src="https://res.cloudinary.com/dgpqwsgck/image/upload/v1733413917/atl8ycz5wwuzednbjwru.webp" alt="4HProtein Store Logo">
    </div>
    <!-- Content Section -->
    <div class="content">
        <h2>Xin chào {{ $user->name }},</h2>
        <p>Cảm ơn Anh/Chị đã đặt hàng tại <strong>4HProtein</strong></p>
        <p>Đơn hàng <span class="highlight">#HD{{ $payment->order->order_id }}</span> của Anh/Chị đã được thanh toán thành công ngày {{ $payment->order->order_date }}.</p>

        <!-- Info Section -->
        <div class="info-section">
            <div class="info-box">
                <h3>Thông tin mua hàng</h3>
                <p>{{ $user->name }}</p>
                <p>{{ $user->email }}</p>
                <p>{{ $user->phone }}</p>
            </div>

            <div class="info-box">
                <h3>Địa chỉ nhận hàng</h3>
                <p>{{ $user->name }}</p>
                <p>{{ $payment->order->address_detail }}</p>
                <p>{{ $user->phone }}</p>
            </div>
        </div>

        <div class="info-section">
            <div class="info-box">
                <h3>Phương thức thanh toán</h3>
                <p>{{ \App\Enum\PaymentMethod::tryFrom($payment->payment_method)->name }}</p>
            </div>

            <div class="info-box">
                <h3>Phương thức vận chuyển</h3>
                <p>Vận chuyển trong {{ \App\Enum\ShipMethod::tryFrom($payment->order->shipment_charges)->name}}</p>
            </div>
        </div>
        <div class="info-section">
            <div class="info-box">
                <h3>Thông tin đơn hàng</h3>
                <p>Mã đơn hàng:<span class="highlight">#HD{{ $payment->order->order_id }}</span></p>
                <p>Ngày đặt hàng: {{ $payment->order->order_date }}</p>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <p>© 2024 4HProtein Store. Tất cả các quyền được bảo lưu.</p>
    </div>
</div>
</body>
</html>
