<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST" || empty($_POST['productId'])) {
    http_response_code(400);
    exit("Yêu cầu không hợp lệ.");
}

$productId = $_POST['productId'];

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    unset($_SESSION['cart'][$productId]);
    http_response_code(200);
    exit("Xóa sản phẩm thành công.");
} else {
    http_response_code(404);
    exit("Không tìm thấy sản phẩm trong giỏ hàng.");
}
?>
