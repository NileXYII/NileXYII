<?php
include 'connection.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id = $id");
$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stocks = $_POST['stocks'];

    $conn->query("UPDATE products SET name='$name', price='$price', stocks='$stocks' WHERE id=$id");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Mabini Vape Shop</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Mabini Vape Shop</h2>
        <a href="index.php">Products</a>
        <a href="add.php">Inventory</a>
        <a href="orders.php">Orders</a>
        <a href="inbox.php">Inbox</a>
        <a href="product-grid.php">Product Grid</a>
        <a href="users.php">Users</a>
        <a href="ratings.php">Ratings</a>
        <a href="land.php" class="logout-btn">LOG OUT</a>
    </div>

    <!-- Top Nav -->
    <div class="top-nav">
        <div class="top-nav-content">
            <h1>Edit Product</h1>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="form-container">
            <form method="POST">
                <input type="text" name="name" value="<?= $product['name'] ?>" placeholder="Product Name" required>
                <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" placeholder="Price" required>
                <input type="number" name="stocks" value="<?= $product['stocks'] ?>" placeholder="Stocks" required>
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>
</body>
</html>

