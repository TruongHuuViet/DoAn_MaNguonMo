<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Đăng Nhập</title>
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
        /* Kiểu cho văn bản "Chưa có tài khoản?" */
        .register-text {
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3 text-center">
                <!-- Thêm hình logo ở đây -->
                <img src="product/logo-shop.png" alt="Logo" width="200px" height="200px" class="mb-4">
                <form action="product.php" method="POST">
                    <input type="email" id="email" name="email" class="form-control mb-3" placeholder="Nhập Email" required>
                    <input type="password" id="password" name="password" class="form-control mb-3" placeholder="Nhập Mật Khẩu" required>
                    <input type="submit" value="Đăng Nhập" class="btn btn-primary btn-lg"> <!-- Lớp btn-lg cho nút lớn hơn -->
                    <div class="mt-3">
                        <!-- Áp dụng kiểu tùy chỉnh cho văn bản -->
                        <p class="register-text">Chưa có tài khoản? <a href="registration.php" class="text-decoration-none">Đăng Ký Tại Đây</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php 
        include "connect.php";

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $query = "SELECT * FROM login WHERE email='$email'";
            $result = $conn->query($query);

            if($result->num_rows == 1){
                $row = $result->fetch_assoc();
                if(password_verify($password, $row['password'])){
                    header("Location: product.php");
                    exit();
                }
            }
            
            // Nếu đăng nhập thất bại, chuyển hướng lại trang đăng nhập
            header("Location: login.php");
            exit();
        }
    ?>
</body>
</html>
