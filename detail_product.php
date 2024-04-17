<?php
include "connect.php";

// Kiểm tra xem có tham số id được truyền từ URL không
if(isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Sử dụng câu lệnh prepared statement để tránh lỗ hổng SQL injection
    $sql = "SELECT * FROM sanpham WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra xem có sản phẩm nào được trả về không
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_name = $row['name'];
        $product_price = $row['price'];
        $product_picture = $row['picture'];
        $product_color = $row['color']; // Thêm màu sắc
        $product_category = $row['category']; // Thêm thể loại
    } else {
        // Nếu không có sản phẩm, chuyển hướng người dùng đến trang không tìm thấy
        header("Location: not_found.php");
        exit();
    }
} else {
    // Nếu không có tham số id, chuyển hướng người dùng đến trang không tìm thấy
    header("Location: not_found.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product_name; ?></title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}


.container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.logo-container img {
    width: 200px;
    height: auto;
}

.search-form input[type="text"] {
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    font-size: 16px;
    width: 300px;
}

.search-form button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.search-form button:hover {
    background-color: #0056b3;
}

.cart-button {
    padding: 10px 20px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
}

.cart-button:hover {
    background-color: #218838;
}

.product-detail {
    display: flex;
}

.product-images {
    flex: 1;
    margin-right: 20px;
}

.product-images img {
    max-width: 100%;
    height: auto;
}

.product-info {
    flex: 1;
}

.product-info h1 {
    font-size: 24px;
    margin-top: 0;
}

.product-info p {
    font-size: 18px;
}

.product-detail-title {
    font-size: 44px; /* Tăng kích thước chữ cho phần tiêu đề */
    margin: 0;
}

.add-to-cart-button,
.back-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
}

.add-to-cart-button:hover,
.back-button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="logo-container">
                <img src="product/logo-shop.png" alt="Logo">
            </div>
            <h3 class="product-detail-title">Chi tiết sản phẩm</h3> 
            <a href="cart.php" class="cart-button">Giỏ hàng</a>            
            <script>
                function addToCart(productId) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "add_to_cart.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                           
                            alert("Sản phẩm đã được thêm vào giỏ hàng!");
                            

                            window.location.href = "cart.php";
                        }
                    };
                    xhr.send("product_id=" + productId);
                }
            </script>

        </header>

        <div class="product-detail">
            <div class="product-images">
                <img src="product/<?php echo $product_picture; ?>" alt="<?php echo $product_name; ?>">
            </div>
            <div class="product-info">
                <h1><?php echo $product_name; ?></h1>
                <p class="price">Giá: <?php echo $product_price; ?></p>
                <p class="color">Màu sắc: <?php echo $product_color; ?></p>
                <p class="category">Thể loại: <?php echo $product_category; ?></p>
                <a href="#" class="add-to-cart-button" onclick="addToCart(<?php echo $product_id; ?>)">Thêm vào giỏ hàng</a>
                <a href="product.php" class="back-button">Quay lại</a>
            </div>
        </div>
   
</body>
</html>
