<?php
session_start();
include_once('connection.php');

// if(isset($_SESSION['name']) && isset($_SESSION['username'] )){

// }
$_SESSION['name'];
$_SESSION['username'];

?>

<!DOCTYPE html>
<html>
<head>
<?php include 'adminnav/admin-nav2.php'; ?>

    <title>Mabini Vape Shop</title>
    <style>
        /* Sidebar styles */
        .sidebar {
            height: 100vh;
            width: 220px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: gray;
            padding-top: 20px;
            color: black;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            color: black;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        /* Main content */
        .content {
            margin-left: 260px; /* Same as the sidebar width */
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="sidebar">
    <h2>Mabini Vape Shop</h2>
        <a href="add.php">Inventory</a>
        <a href="orders.php">Orders</a>
        <a href="inbox.php">Inbox</a>
        <a href="product-grid.php">Product Grid</a>
        <a href="users.php">Users</a>
        <a href="ratings.php">Ratings</a>
        <a href="#">Logout</a>
    </div>

    <div class="content">
        <h1>Manage Products</h1>
        <form method="POST">
            <input type="text" name="name" placeholder="Product Name" required>
            <input type="number" step="0.01" name="price" placeholder="Price" required>
            <textarea name="description" placeholder="Description"></textarea>
            <button type="submit" name="add">Add Product</button>
        </form>

        <h2>Product List</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>
                    <a href="?delete=<?php echo $row['id']; ?>">Delete</a>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="name" value="<?php echo $row['name']; ?>">
                        <input type="number" step="0.01" name="price" value="<?php echo $row['price']; ?>">
                        <textarea name="description"><?php echo $row['description']; ?></textarea>
                        <button type="submit" name="update">Update</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
