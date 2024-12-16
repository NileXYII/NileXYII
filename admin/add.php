<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $name = $conn->real_escape_string(trim($_POST['name']));
    $price = $conn->real_escape_string(trim($_POST['price']));
    $stocks = $conn->real_escape_string(trim($_POST['stocks']));

    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "Error: The uploaded file is not a valid image.";
        $uploadOk = 0;
    }

    // Allow only specific file formats
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowedTypes)) {
        echo "Error: Only JPG, JPEG, PNG & GIF file types are allowed.";
        $uploadOk = 0;
    }

    // Attempt to upload the file
    if ($uploadOk === 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insert product data into database
            $sql = "INSERT INTO products (name, price, stocks, image) 
                    VALUES ('$name', '$price', '$stocks', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                header("Location: index.php");
                exit;
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Error: There was an issue uploading the file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product - Mabini Vape Shop</title>
    <link rel="stylesheet" href="add.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Mabini Vape Shop</h2>
        <a href="index.php">Inventory</a>
        <a href="orders.php">Orders</a>
        <a href="inbox.php">Inbox</a>
        <a href="product-grid.php">Product Grid</a>
        <a href="users.php">Users</a>
        <a href="ratings.php">Ratings</a>
        <a href="#">Logout</a>
    </div>

    <!-- Form Container -->
    <div class="main-content">
        <div class="form-container">
            <h1>Add New Product</h1>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Product Name" required>
                <input type="number" step="0.01" name="price" placeholder="Price" required>
                <input type="number" name="stocks" placeholder="Stocks" required>
                <input type="file" name="image" required>
                <button type="submit">Add Product</button>
            </form>
        </div>
    </div>
</body>
</html>
