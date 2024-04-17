<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form {
            margin-bottom: 20px;
        }
        form p {
            margin-top: 10px;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 10px;
        }
        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Product</h2>
        <form action="add_product.php" method="post" enctype="multipart/form-data">
            <p>Name:</p>
            <input type="text" name="name" required>

            <p>Picture:</p>
            <input type="file" name="picture" accept="image/*" required>

            <p>Color:</p>
            <input type="text" name="color" required>
            
            <p>Category:</p>
            <input type="text" name="category" required>

            <p>Price:</p>
            <input type="text" name="price" required>

            <button type="submit" name="btn">Submit</button>
        </form>
    </div>
</body>
</html>

<?php
    include "connect.php";

    if(isset($_POST['btn'])){
        
        $name = $_POST['name'];
        $color = $_POST['color']; 
        $category = $_POST['category'];  
        
        $picture = $_FILES['picture']['name'];
        $picture_tmp_name = $_FILES['picture']['tmp_name'];

        $price = $_POST['price']; 

        $sql = "INSERT INTO sanpham(name, picture, color, category, price) VALUE('$name', '$picture', '$color', '$category','$price') ";
        
        mysqli_query($conn, $sql);

        move_uploaded_file($picture_tmp_name, 'img/product/' . $picture);

        header('Location: product.php');
        exit(); 
    }
?>
