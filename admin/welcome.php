<?php
session_start();
include 'adminnav/admin-nav.php';
include 'connection.php'; // Include your database connection file

// Fetch data from the database
$userCount = $conn->query("SELECT COUNT(*) AS count FROM tbl_user")->fetch_assoc()['count'];
$productCount = $conn->query("SELECT COUNT(*) AS count FROM products")->fetch_assoc()['count'];
$orderCount = $conn->query("SELECT COUNT(*) AS count FROM orders")->fetch_assoc()['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <style>
    body {
        font-family: 'Arial', sans-serif;
        background: url('3.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #333;
        margin: 0;
        padding: 0;
        animation: backgroundAnimation 10s infinite alternate;
    }

    @keyframes backgroundAnimation {
        0% { filter: brightness(1); }
        100% { filter: brightness(0.8); }
    }

    .dashboard {
        max-width: 1200px;
        margin: 50px auto;
        padding: 20px;
        background-color: rgba(201, 233, 208, 0.9);
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #2c3e50;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .stat {
        background-color:rgb(124, 189, 233);
        color: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat h2 {
        margin-bottom: 10px;
    }

    .stat p {
        font-size: 2rem;
        margin: 0;
    }

    .stat:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
  </style>
</head>
<body>
  <div class="dashboard">
    <h1>Admin Overview Dashboard</h1>
    <div class="stats">
      <div class="stat">
        <h2>Users</h2>
        <p><?= $userCount ?></p>
      </div>
      <div class="stat">
        <h2>Products</h2>
        <p><?= $productCount ?></p>
      </div>
      <div class="stat">
        <h2>Orders</h2>
        <p><?= $orderCount ?></p>
      </div>
      <div class="stat">
        <h2>Messages</h2>
        <p></p>
      </div>
      
    </div>
  </div>

  <div class="dashboard">
    <h1>Product Rating Dashboard</h1>
    <div class="stats">
      <div class="stat">
        <h2>Best Sellers</h2>
        <p></p>
      </div>
      <div class="stat">
        <h2>Out of Stocks</h2>
        <p></p>
      </div>
      <div class="stat">
        <h2>Least Viewed</h2>
        <p></p>
      </div>
      <div class="stat">
        <h2>Top Users</h2>
        <p></p>
      </div>
      <div class="stat">
        <h2>Total Sales</h2>
        <p></p>
      </div>
    </div>
  </div>
  <script src="welcome.js"></script>
</body>
</html>
