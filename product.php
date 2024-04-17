<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
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
        h1, h2 {
            text-align: center;
            color: #343a40;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo-container {
            flex: 1;
            text-align: left;
        }
        .logo-container img {
            width: 300px;
            height: 300px;
        }
        .search-form {
            flex: 1;
            text-align: center;
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
        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 0;
            margin: 0;
            list-style-type: none;
        }
        .product-list li {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s ease;
        }
        .product-list li:hover {
            transform: translateY(-5px);
        }
        .product-info {
            text-align: center;
        }
        .product-info h3 {
            color: #343a40;
            font-size: 20px;
            margin-bottom: 10px;
        }
        .product-info p {
            color: #6c757d;
            font-size: 18px;
        }
        .product-info img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .add-product-link {
            margin-bottom: 20px;
            display: block;
            text-align: right;
        }
        .action-links {
            margin-top: 10px;
        }
        .action-links a {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .action-links a:hover {
            text-decoration: underline;
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
        .product-detail-link {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .product-detail-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Trang Chủ</h1>

        <div class="header">
            <div class="logo-container">
                <img src="product/logo-shop.png" alt="Logo">
            </div>

            <form class="search-form" method="post">
                <input type="text" name="noidung" placeholder="Nhập từ khóa">
                <button type="submit" name="btn">Tìm kiếm sản phẩm</button>
            </form>

            <a href="cart.php" class="cart-button">Giỏ hàng</a>
        </div>

        <?php
        include "connect.php";

        if(isset($_POST['btn'])) {
            $noidung = $_POST['noidung'];
            $sql = "SELECT * FROM sanpham WHERE name LIKE '%$noidung%'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0) {
                echo "<h2>Kết quả tìm kiếm:</h2>";
                echo "<ul class='product-list'>";
                while($row = mysqli_fetch_array($result)) {
                    echo "<li>";
                    echo "<div class='product-info'>";
                    echo "<h3>" . $row['name'] . "</h3>";
                    echo "<img src='product/" . $row['picture'] . "' alt='" . $row['name'] . "'>";
                    echo "<p>Giá: " . $row['price'] . "</p>";
                    echo "<a href='product_detail.php?id=" . $row['id'] . "' class='product-detail-link'>Xem chi tiết</a>";
                    echo "</div>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Không tìm thấy sản phẩm nào.</p>";
            }
        }
        ?>

        <h2>Danh sách sản phẩm</h2>
                
        <!-- Nút Thêm sản phẩm -->
        <div class="add-product-link">
            <a href="add_product.php">Thêm sản phẩm</a>
        </div>
        <ul class="product-list">
            <?php
            include "connect.php";
            
            $sql = "SELECT * FROM sanpham ORDER BY name ASC";
            $result = mysqli_query($conn, $sql);

            while($row  = mysqli_fetch_array($result)){
                ?>
                <li>
                    <div class="product-info">
                        <h3><?php echo $row['name'] ?></h3>
                        <img src="product/<?php echo $row['picture'] ?>" alt="<?php echo $row['name'] ?>">
                        <?php echo $row['color'] ?>
                        <?php echo $row['category'] ?>
                        <p>Giá: <?php echo $row['price'] ?></p>
                        <a href="detail_product.php?id=<?php echo $row['id'] ?>" class="product-detail-link">Xem chi tiết</a>
                        <div class="action-links">
                            <a href="delete_product.php?this_id=<?php echo $row['id'] ?>">Xóa</a>
                            <a href="edit_product.php?this_id=<?php echo $row['id'] ?>">Sửa</a>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>

    </div>
</body>
</html>
