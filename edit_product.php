<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            text-align: center;
        }
        form p {
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="file"] {
            margin-top: 5px;
        }
        button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        img {
            max-width: 100px;
            max-height: 100px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        include "connect.php";

        $this_id = $_GET['this_id'];

        $sql = "SELECT * FROM sanpham WHERE id = ".$this_id;

        $query = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($query);

        if(isset($_POST['btn'])){

            $name = $_POST['name'];
            $color = $_POST['color'];
            $category = $_POST['category'];
            $price = $_POST['price'];
            $picture = $_FILES['picture']['name'];
            $picture_tmp_name = $_FILES['picture']['tmp_name'];

            $sql = "UPDATE sanpham SET name='$name', Picture='$picture', color='$color', category='$category',price='$price' WHERE id=".$this_id;

            mysqli_query($conn, $sql);
            move_uploaded_file($picture_tmp_name, 'img/product/'.$picture);

            header('location: product.php');
            exit();
        }
        ?>
        <h1>Edit Product: <?php echo $row['name']; ?></h1>
        <form method="post" enctype="multipart/form-data">
            <p>Name</p>
            <input type="text" name="name" value="<?php echo $row['name']; ?>">
            
            <p>Image</p>
            <img src="product/<?php echo $row['picture']; ?>" alt="" width="100" height="100"><br>
            <input type="file" name="picture">

            <p>Color</p>
            <input type="text" name="color" value="<?php echo $row['color']; ?>">

            <p>Categort</p>
            <input type="text" name="category" value="<?php echo $row['category']; ?>">

            <p>Price:</p>
            <input type="text" name="price" value="<?php echo $row['price']; ?>"><br>
            <button type="submit" name="btn">Submit</button>
        </form>
    </div>
</body>
</html>
