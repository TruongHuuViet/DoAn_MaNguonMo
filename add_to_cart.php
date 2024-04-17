<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        
        addToCart($product_id);
    }
}

function addToCart($product_id) {
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    if(isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }

    echo "success";
}
?>
