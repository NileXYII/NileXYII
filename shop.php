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

// Fetch products
$result = $conn->query("SELECT id, name, price, description FROM products ORDER BY name ASC");
?>

<!DOCTYPE html>
<html>
<?php include 'userdashboard/user-nav.php'; ?>

<head>
    <title>Shop - Mabini Vape Shop</title>
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

        .product-card {
            border: 1px solid black;
            border-radius: 5px;
            padding: 15px;
            margin: 10px;
            display: inline-block;
            width: calc(30% - 20px);
            box-sizing: border-box;
            text-align: center;
        }

        .product-card h3 {
            margin: 10px 0;
        }

        .product-card p {
            margin: 5px 0;
        }

        .product-card button {
            padding: 10px 15px;
            background-color: #575757;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .product-card button:hover {
            background-color: black;
        }
    </style>
</head>
<body>
   

    <div class="content">
        <h1>Welcome, Yvan!</h1>
        <h2>Our Products</h2>

        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="product-card">
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <p>Price: <?php echo number_format($row['price'], 2); ?> PHP</p>
            <p><?php echo htmlspecialchars($row['description']); ?></p>
            <form method="POST" action="add_to_cart.php">
                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                <button type="submit">Add to Cart</button>
            </form>
        </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
