<?php
// Start session
session_start();

// Mock cart data (replace with actual cart logic)
$total_amount = 500.00;
$cart_items = [
    ['name' => 'Item 1', 'quantity' => 1, 'price' => 200.00],
    ['name' => 'Item 2', 'quantity' => 2, 'price' => 150.00],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'usernavigation.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #e2e2e2, #ffffff);
            margin: 0;
            padding: 0;
        }

        /* Navigation Bar */
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

        /* Checkout Container */
        .checkout-container {
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

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            font-size: 1rem;
            color: #555;
        }

        input, select {
            padding: 10px;
            margin-bottom: 15px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input:focus, select:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            padding: 12px;
            font-size: 1.2rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .checkout-container {
                padding: 20px;
                margin: 20px;
            }
            h1 {
                font-size: 1.5rem;
            }
            input, select {
                font-size: 0.9rem;
            }
            button {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="checkout-container">
        <h1>Checkout Page</h1>
        <form action="confirmation.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Your Name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Your Email" required>

            <label for="address">Address:</label>
            <input type="text" name="address" id="address" placeholder="Your Address" required>

            <label for="payment_method">Payment Method:</label>
            <select name="payment_method" id="payment_method" required>
                <option value="Cash on Delivery">Cash on Delivery</option>
                <option value="Credit Card">Credit Card</option>
            </select>

            <!-- Hidden fields to pass cart data -->
            <input type="hidden" name="total_amount" value="<?= $total_amount; ?>">
            <input type="hidden" name="cart_items" value='<?= json_encode($cart_items); ?>'>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
