<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

if ($result === false) {
    die("Error fetching the orders: " . $conn->error);
}

$orders = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Orders</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f3f4f6;
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar styles */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
            padding: 1.5rem;
        }

        .sidebar h2 {
            color: white;
            font-size: 1.25rem;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar a {
            display: block;
            color: #e2e8f0;
            text-decoration: none;
            padding: 0.75rem 1rem;
            margin: 0.5rem 0;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .sidebar a.active {
            background-color: #3b82f6;
            color: white;
        }

        /* Main content area */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 2rem;
            background-color: #f3f4f6;
            min-height: 100vh;
        }

        /* Header section */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background-color: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: #1e293b;
            font-size: 1.875rem;
            font-weight: 600;
            margin: 0;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
        }

        /* Table container */
        .orders-list {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        thead {
            background-color: #f8fafc;
        }

        th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #4a5568;
            font-size: 0.875rem;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            color: #4a5568;
            font-size: 0.875rem;
        }

        tr:hover {
            background-color: #f8fafc;
        }

        /* Status badges */
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-block;
        }

        .status-pending {
            background-color: #fff7ed;
            color: #c2410c;
        }

        .status-processing {
            background-color: #ecfdf5;
            color: #047857;
        }

        .status-completed {
            background-color: #f0f9ff;
            color: #0369a1;
        }

        .status-cancelled {
            background-color: #fef2f2;
            color: #dc2626;
        }

        /* Action buttons */
        .actions {
            display: flex;
            gap: 0.5rem;
        }

        button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .btn-track {
            background-color: #3b82f6;
            color: white;
        }

        .btn-track:hover {
            background-color: #2563eb;
        }

        .btn-contact {
            background-color: #10b981;
            color: white;
        }

        .btn-contact:hover {
            background-color: #059669;
        }

        .export-btn {
            background-color: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .export-btn:hover {
            background-color: #2563eb;
        }

        .filter-status {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            border: 1px solid #e2e8f0;
            background-color: white;
            cursor: pointer;
        }

        .no-orders {
            text-align: center;
            color: #6b7280;
            font-style: italic;
            padding: 3rem !important;
        }

        /* Responsive design */
        @media (max-width: 1024px) {
            .sidebar {
                width: 200px;
            }
            .main-content {
                margin-left: 200px;
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 1rem;
            }

            .sidebar h2 {
                padding-bottom: 1rem;
                margin-bottom: 1rem;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .header {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .header-actions {
                flex-direction: column;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Mabini Vape Shop</h2>
        <nav>
            <a href="index.php">Dashboard</a>
            <a href="inventory.php">Inventory</a>
            <a href="orders.php" class="active">Orders</a>
            <a href="inbox.php">Inbox</a>
            <a href="product-grid.php">Product Grid</a>
            <a href="users.php">Users</a>
            <a href="ratings.php">Ratings</a>
            <a href="logout.php">Logout</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Order Management</h1>
            <div class="header-actions">
                <button class="export-btn">Export to CSV</button>
                <select class="filter-status">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        <div class="orders-list">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Order Date</th>
                        <th>Total Amount</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($orders) > 0): ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td>#<?= htmlspecialchars($order['order_id']) ?></td>
                                <td><?= htmlspecialchars($order['name']) ?></td>
                                <td><?= htmlspecialchars($order['email']) ?></td>
                                <td><?= htmlspecialchars($order['order_date']) ?></td>
                                <td>₱<?= htmlspecialchars(number_format($order['total_amount'], 2)) ?></td>
                                <td><?= htmlspecialchars($order['payment_method']) ?></td>
                                <td>
                                    
                                </td>
                                <td class="actions">
                                    <button class="btn-track" onclick="trackOrder(<?= htmlspecialchars($order['order_id']) ?>)">
                                        Track
                                    </button>
                                    <button class="btn-contact" onclick="contactUser('<?= htmlspecialchars($order['email']) ?>')">
                                        Contact
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="no-orders">No orders found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function trackOrder(orderId) {
            window.location.href = `track-order.php?id=${orderId}`;
        }

        function contactUser(userEmail) {
            window.location.href = `send-message.php?email=${userEmail}`;
        }

        document.querySelector('.filter-status').addEventListener('change', function(e) {
            const status = e.target.value;
        });
    </script>
</body>
</html>