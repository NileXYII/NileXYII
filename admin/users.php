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

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'login_register_db';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users
$result = $conn->query("SELECT id, name, username, email, role, created_at FROM users ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <?php include 'adminnav/admin-nav2.php'; ?>
    <title>Users Management</title>
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
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h1>Users Management</h1>

        <h2>Registered Users</h2>
        <table>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['role']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                    <!-- Edit User Form -->
                    <form method="POST" class="form-inline">
                        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="edit_user">Edit</button>
                    </form>

                    <!-- Delete User Form -->
                    <form method="POST" class="form-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete_user">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
