<?php
session_start();

include('connection.php'); 

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = uniqid("ORDER-");
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];
    $cart_items = $_POST['cart_items'];
    $total_amount = $_POST['total_amount'];

    $query = "INSERT INTO orders (order_id, name, email, address, payment_method, cart_items, total_amount) 
              VALUES (?, ?, ?, ?, ?, ?, ?);";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ssssssd", $order_id, $name, $email, $address, $payment_method, $cart_items, $total_amount);

        if ($stmt->execute()) {
            $message = "Order placed successfully!";
        } else {
            $message = "Error placing the order: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "Error preparing the statement: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: checkout.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'usernavigation.php'; ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f1f1f1, #ffffff);
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #333;
            padding: 1rem;
            color: white;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            font-size: 18px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .confirmation-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            text-align: center;
            font-size: 2rem;
            color: #333;
            margin-bottom: 30px;
        }

        p {
            font-size: 1.2rem;
            color: #555;
            line-height: 1.6;
            text-align: center;
        }

        .confirmation-container p {
            margin-bottom: 15px;
        }

        .order-id {
            font-size: 1.4rem;
            color: #007bff;
        }

        @media (max-width: 768px) {
            .confirmation-container {
                padding: 20px;
                margin: 20px;
            }
            h1 {
                font-size: 1.5rem;
            }
            p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <h1>Order Confirmation</h1>
        <p><?= htmlspecialchars($message) ?></p>
        <?php if (isset($order_id)): ?>
            <p class="order-id">Your Order ID: <?= htmlspecialchars($order_id) ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
