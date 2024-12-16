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
        <a href="land.php" class="logout-btn">LOG OUT</a>
        </div>

    <!-- Main content container -->
    <div class="main-content">
        <!-- Top Navigation -->
        <div class="top-nav">
            <a href="welcome.php" class="logo"></a>
            <div class="nav-links">
                <a href="profile.php">Profile</a>
                <a href="land.php" class="logout-btn">LOG OUT</a>
                </div>
        </div>

        <!-- Content area -->
        <div class="content">
            <h1>Product List</h1>
            <a href="add.php" class="add-product-btn">Add New Product</a>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stocks</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><img src="<?= $row['image'] ?>" alt="Product Image"></td>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['price'] ?></td>
                        <td><?= $row['stocks'] ?></td>
                        <td class="actions">
                            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                            <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
