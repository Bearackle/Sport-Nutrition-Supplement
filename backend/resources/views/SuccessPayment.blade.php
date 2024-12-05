<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán thành công</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.webp') }}">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }
        h2 {
            font-family: Helvetica, serif;
            font-size: 36px;
            margin-top: 40px;
            color: #333;
            opacity: 0;
            animation: .6s title ease-in-out;
            animation-delay: 1.2s;
            animation-fill-mode: forwards;
        }
        .circle {
            stroke-dasharray: 1194;
            stroke-dashoffset: 1194;
            animation: circle 1s ease-in-out;
            animation-fill-mode: forwards;
        }

        .tick {
            stroke-dasharray: 350;
            stroke-dashoffset: 350;
            animation: tick .8s ease-out;
            animation-fill-mode: forwards;
            animation-delay: .95s;
        }

        @keyframes circle {
            from {
                stroke-dashoffset: 1194;
            }
            to {
                stroke-dashoffset: 2388;
            }
        }

        @keyframes tick {
            from {
                stroke-dashoffset: 350;
            }
            to {
                stroke-dashoffset: 0;
            }
        }

        @keyframes title {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
<svg width="400" height="400">
    <circle fill="none" stroke="#68E534" stroke-width="20" cx="200" cy="200" r="190" class="circle" stroke-linecap="round" transform="rotate(-90 200 200) "/>
    <polyline fill="none" stroke="#68E534" stroke-width="24" points="88,214 173,284 304,138" stroke-linecap="round" stroke-linejoin="round" class="tick" />
</svg>
<h2>Đặt hàng thành công! bạn có thể đóng cửa sổ này</h2>
</body>
</html>
