<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
        }

        p {
            margin: 10px 0;
        }

        .qr-code {
            display: block;
            margin: 20px auto;
            max-width: 300px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Thanh toán</h2>
        <img src="product/QR_VCB.png" alt="QR ATM Code" class="qr-code" width="500px" height="500px">
        <p>Vui lòng quét mã QR trên để thực hiện thanh toán.</p>
        <a href="product.php" class="button">Quay lại trang chủ</a>
    </div>
</body>
</html>
