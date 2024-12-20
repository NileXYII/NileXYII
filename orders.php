<?php
session_start();
include 'connection.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    echo "Session ID not set. Redirecting to login page.";
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];

// Fetch orders from the database
$sql = "SELECT * FROM orders WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing the SQL statement: " . $conn->error);
}
$stmt->bind_param("i", $id); // Fixed variable name
if (!$stmt->execute()) {
    die("Error executing the SQL statement: " . $stmt->error);
}
$result = $stmt->get_result();
if ($result === false) {
    die("Error fetching the result: " . $conn->error);
}
$orders = $result->fetch_all(MYSQLI_ASSOC);

// Close statement and connection
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'usernavigation.php'; ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .orders-container {
            max-width: 800px;
            margin: 50px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .header h1 {
            text-align: center;
            margin: 0;
            padding-bottom: 20px;
            border-bottom: 2px solid #e4e4e4;
            color: #333;
        }
        .orders-list {
            margin-top: 20px;
        }
        .order-item {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fafafa;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .order-item .order-details p {
            margin: 5px 0;
            color: #555;
        }
        .order-item .order-details p strong {
            color: #333;
        }
        .order-actions {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }
        .order-actions button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        .order-actions button:hover {
            opacity: 0.9;
        }
        .order-actions button:nth-child(1) {
            background-color: #4caf50;
            color: white;
        }
        .order-actions button:nth-child(2) {
            background-color: #007bff;
            color: white;
        }
        .status {
            font-weight: bold;
            text-transform: capitalize;
            color: #4caf50;
        }
    </style>
</head>
<body>
    <div class="orders-container">
        <div class="header">
            <h1>My Orders</h1>
        </div>
        <div class="orders-list">
            <?php if (count($orders) > 0): ?>
                <?php foreach ($orders as $order): ?>
                    <div class="order-item">
                        <div class="order-details">
                            <p><strong>Order ID:</strong> <?= htmlspecialchars($order['order_id']) ?></p>
                            <p><strong>Name:</strong> <?= htmlspecialchars($order['name']) ?></p>
                            <p><strong>Email:</strong> <?= htmlspecialchars($order['email']) ?></p>
                            <p><strong>Address:</strong> <?= htmlspecialchars($order['address']) ?></p>
                            <p><strong>Placed On:</strong> <?= htmlspecialchars($order['order_date']) ?></p>
                            <p><strong>Total Amount:</strong> <?= htmlspecialchars($order['total_amount']) ?></p>
                            <p><strong>Payment Method:</strong> <?= htmlspecialchars($order['payment_method']) ?></p>
                        </div>
                        <div class="order-actions">
                            <button onclick="trackOrder('<?= htmlspecialchars($order['order_id']) ?>')">Track Order</button>
                            <button onclick="contactSeller('<?= htmlspecialchars($order['order_id']) ?>')">Contact Seller</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align: center; color: #777;">No orders found.</p>
            <?php endif; ?>
        </div>
    </div>
    <script>
        function trackOrder(orderId) {
            // Implement order tracking functionality
            alert('Tracking order: ' + orderId);
        }

        function contactSeller(orderId) {
            // Implement contact seller functionality
            alert('Contacting seller for order: ' + orderId);
        }
    </script>
</body>
</html>
