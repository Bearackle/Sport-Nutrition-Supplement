<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>4h-protein</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.webp') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #f3caff, #d0a4f0);
            color: #fff;
            text-align: center;
            overflow: hidden;
        }

        .container {
            position: relative;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h1 {
            font-size: 4rem;
            margin: 0;
            color: #ffffff;
        }

        p {
            font-size: 1.2rem;
            margin: 10px 0 20px;
            color: #f3e6ff;
        }

        .input-container {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 5px 5px 5px 5px;
            background-color: #5a00c6;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #7e34e8;
        }

        .social-icons {
            margin-top: 20px;
        }

        .social-icons a {
            margin: 0 10px;
            font-size: 1.5rem;
            color: #ffffff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #cfc3ff;
        }

        .background {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 50%;
            background: linear-gradient(to top, #6600b8, transparent);
            z-index: -1;
        }

        .trees {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 20%;
            background: url("https://via.placeholder.com/100x50") repeat-x;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Chào mừng đến hệ thống 4h-Protein</h1>
    <h3>Hệ thống bán lẻ thực phẩm chức năng, thể thao</h3>
    <div class="input-container">
        <a href="http://dinhhuan.id.vn/documentation" target="_blank"
        ><button>Trang quản trị viên</button></a
        >
    </div>
    <div class="input-container">
        <a href="https://4hprotein.vercel.app/" target="_blank"
        ><button>Trang mua hàng</button></a
        >
    </div>
</div>
<div class="background"></div>
</body>
</html>
