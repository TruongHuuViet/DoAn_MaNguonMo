<?php
session_start();

include "connect.php";

$total_price = 0;

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Giỏ hàng của bạn đang trống.";
} else {
    echo "<h2>Giỏ hàng của bạn:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Tên sản phẩm</th><th>Giá</th><th>Số lượng</th><th>Tổng cộng</th><th>Thao tác</th></tr>";
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $stmt = $conn->prepare("SELECT * FROM sanpham WHERE id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $product_name = $row['name'];
            $product_price = $row['price']; 
            $total_product_price = $product_price * $quantity;
            $total_price += $total_product_price;

            echo "<tr>";
            echo "<td>$productId</td>";
            echo "<td>$product_name</td>";
            echo "<td>$product_price</td>";
            echo "<td>$quantity</td>";
            echo "<td>$total_product_price</td>";
            echo "<td><button class='remove-button' data-product-id='$productId'>Xóa</button></td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <style>

    .container {
        width: 150px;
        margin: 0 auto;
        border: 5px solid #ccc;
        padding: 10px;
        float: left;
        color: #fff; 
        text-align: center;

    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .gender-column {
        text-align: center;
    }

    .gender-image {
        max-width: 50px;
        max-height: 50px;
    }

    h1 {
        text-align: center;
        color: #007bff;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination a {
        margin: 0 5px;
        padding: 5px 10px;
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        text-decoration: none;
        color: #333;
    }

    .pagination a.active {
        background-color: #007bff;
        color: #fff;
    }

    .checkout-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    float: right;
}

.checkout-button:hover {
    background-color: #0056b3;
}

.total-price {
    text-align: right; 
    margin-top: 10px; 
}

.total-price {
    text-align: right;
    margin-top: 10px; 
}

</style>
</head>
<body>
    <p class='total-price'><strong>Tổng tiền: <?php echo $total_price; ?></strong></p>
    <a href="checkout.php" class="checkout-button">Thanh toán</a>

    <div class="container">
        <header class="header">
            <a href="product.php" class="back-button">Quay lại cửa hàng</a>
        </header>
        <div class="cart">
        </div>
    </div>

    <script>
    document.querySelectorAll('.remove-button').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            fetch('remove_product.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ productId }),
            })
            .then(response => {
                if (response.ok) {
                    this.closest('tr').remove();
                } else {
                    console.error('Xóa sản phẩm không thành công.');
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
            });
        });
    });
</script>
</body>
</html>