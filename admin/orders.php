<?php 
session_start();
include_once('connection.php');

// Ensure session variables are set
if (!isset($_SESSION['name']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$name = $_SESSION['name'];
$username = $_SESSION['username'];





if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update order status
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    $conn->query("UPDATE orders SET status = '$status' WHERE id = $order_id");
}

// Assign order to a user
if (isset($_POST['assign_order'])) {
    $order_id = $_POST['order_id'];
    $assigned_to = $_POST['assigned_to'];
    $conn->query("UPDATE orders SET assigned_to = '$assigned_to' WHERE id = $order_id");
}

// Fetch orders
$result = $conn->query("
    SELECT orders.id, products.name AS product_name, orders.customer_name, orders.customer_address, 
           orders.status, orders.assigned_to, orders.created_at 
    FROM orders 
    INNER JOIN products ON orders.product_id = products.id
    ORDER BY orders.created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <?php include 'adminnav/admin-nav2.php'; ?>
    <title>Admin Panel</title>
    <style>
        /* Sidebar styles */
        .sidebar {
            height: 100vh;
            width: 200px;
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

        .form-inline {
            display: flex;
            gap: 10px;
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
        <h1>Welcome, <?php echo htmlspecialchars($name); ?>!</h1>

        <h2>Order Management</h2>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Product</th>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Status</th>
                <th>Assigned To</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['customer_name']; ?></td>
                <td><?php echo $row['customer_address']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['assigned_to'] ?? 'Not Assigned'; ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                    <!-- Update Status Form -->
                    <form method="POST" class="form-inline">
                        <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                        <select name="status" required>
                            <option value="Pending" <?php echo $row['status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="Processing" <?php echo $row['status'] === 'Processing' ? 'selected' : ''; ?>>Processing</option>
                            <option value="Completed" <?php echo $row['status'] === 'Completed' ? 'selected' : ''; ?>>Completed</option>
                            <option value="Cancelled" <?php echo $row['status'] === 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                        </select>
                        <button type="submit" name="update_status">Update</button>
                    </form>

                    <!-- Assign Order Form -->
                    <form method="POST" class="form-inline">
                        <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="assigned_to" placeholder="Assign to" value="<?php echo $row['assigned_to']; ?>">
                        <button type="submit" name="assign_order">Assign</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
