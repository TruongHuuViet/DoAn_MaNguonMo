<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Đăng Ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #1d2630;
        }
        .container {
            margin-top: 100px;
        }
        .input {
            max-width: 300px;
            min-width: 300px;
        }
        .register-text {
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3 text-center">
                <img src="product/logo-shop.png" alt="Logo" width="200px" height="200px" class="mb-4">
                <form action="registration.php" method="POST">
                    <input type="text" id="username" name="username" class="form-control mb-3" placeholder="Nhập Tên Tài Khoản" required>
                    <input type="email" id="email" name="email" class="form-control mb-3" placeholder="Nhập Email" required>
                    <input type="password" id="password" name="password" class="form-control mb-3" placeholder="Nhập Mật Khẩu" required>
                    <input type="password" id="repeat_password" name="repeat_password" class="form-control mb-3" placeholder="Nhập Lại Mật Khẩu" required>
                    <input type="submit" value="Đăng Ký" class="btn btn-primary btn-lg"> 
                    <div class="mt-3">
                        <p class="register-text">Đã có tài khoản? <a href="login.php" class="text-decoration-none">Đăng Nhập Tại Đây</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
