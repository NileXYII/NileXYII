<?php
include 'connection.php';

$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="index.css"> 
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

    <!-- Main content container -->
    <div class="main-content">
        <!-- Top Navigation -->
        <div class="top-nav">
            <a href="welcome.php" class="logo"></a>
            <div class="nav-links">
                <a href="profile.php">Profile</a>
                <a href="#">Logout</a>
            </div>
        </div>

        <!-- Content area -->
        <div class="content">
            <h1>Ratings</h1>
            <a href="" class="add-product-btn">Coming Soon</a>
            
        </div>
    </div>
</body>
</html>
