<?php
session_start();
include 'connection.php';

// Function to clean and validate image path
function getFullImagePath($imagePath) {
    // Remove duplicate uploads and normalize path
    $cleanPath = preg_replace('/uploads\/uploads\//', 'uploads/', $imagePath);
    
    // Construct full path
    $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/vape/admin/' . $cleanPath;
    
    // Normalize path separators
    $fullPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $fullPath);
    
    return $fullPath;
}

// Function to get display image path
function getDisplayImagePath($imagePath) {
    // Remove duplicate uploads
    $cleanPath = preg_replace('/uploads\/uploads\//', 'uploads/', $imagePath);
    return 'admin/' . $cleanPath;
}

// Handle Remove from Cart
if (isset($_GET['remove']) && isset($_SESSION['cart'])) {
    $remove_id = $_GET['remove'];
    
    // Remove specific item from cart
    $_SESSION['cart'] = array_filter($_SESSION['cart'], function($item) use ($remove_id) {
        return $item['id'] != $remove_id;
    });
}

// Handle Update Quantity
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as &$item) {
            if (isset($_POST['quantity'][$item['id']])) {
                // Validate quantity (between 1-10)
                $new_quantity = max(1, min(10, intval($_POST['quantity'][$item['id']])));
                $item['quantity'] = $new_quantity;
            }
        }
    }
}

// Calculate Cart Totals
function calculateCartTotal($cart) {
    $total = 0;
    if (!empty($cart)) {
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    }
    return $total;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
        }

        .cart-container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            position: relative;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background-color: #3498db;
        }

        /* Cart Item Styles */
        .cart-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eee;
            transition: background-color 0.3s ease;
        }

        .cart-item:hover {
            background-color: #f9f9f9;
        }

        .cart-item img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            margin-right: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .cart-item-details {
            flex-grow: 1;
        }

        .cart-item-details h2 {
            font-size: 1.2rem;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .cart-item-details p {
            color: #27ae60;
            font-weight: bold;
        }

        .cart-item-actions {
            display: flex;
            align-items: center;
        }

        .cart-item-actions input {
            width: 60px;
            padding: 8px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
        }

        .remove-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .remove-btn:hover {
            background-color: #c0392b;
        }

        /* Cart Summary */
        .cart-summary {
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            text-align: right;
        }

        .cart-summary h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .checkout-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            margin-left: 10px;
            transition: background-color 0.3s ease;
        }

        .checkout-btn:hover {
            background-color: #2980b9;
        }

        .empty-cart {
            text-align: center;
            padding: 50px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .empty-cart .btn {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .cart-item {
                flex-direction: column;
                text-align: center;
            }

            .cart-item img {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .cart-item-actions {
                flex-direction: column;
            }

            .cart-item-actions input {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="cart-container">
        <h1>Your Shopping Cart</h1>

        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
            <form method="POST" action="">
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="cart-item">
                        <?php 
                        // Get full and display paths
                        $fullImagePath = getFullImagePath($item['image']);
                        $displayImagePath = getDisplayImagePath($item['image']);

                        // Debug information
                        echo "<!-- Debug: 
                        Full Image Path: $fullImagePath
                        Display Image Path: $displayImagePath -->";
                        ?>
                        
                        <?php if (file_exists($fullImagePath)): ?>
                            <img src="<?= htmlspecialchars($displayImagePath) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                        <?php else: ?>
                            <div style="width:120px; height:120px; background-color:#f1f1f1; display:flex; align-items:center; justify-content:center;">
                                Image Not Found
                            </div>
                        <?php endif; ?>
                        
                        <div class="cart-item-details">
                            <h2><?= htmlspecialchars($item['name']) ?></h2>
                            <p>Price: <?= number_format($item['price'], 2) ?> PHP</p>
                        </div>
                        
                        <div class="cart-item-actions">
                            <input 
                                type="number" 
                                name="quantity[<?= $item['id'] ?>]" 
                                value="<?= $item['quantity'] ?>" 
                                min="1" 
                                max="10"
                            >
                            <a href="cart.php?remove=<?= $item['id'] ?>" class="remove-btn">Remove</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <div class="cart-summary">
                    <h3>Total: <?= number_format(calculateCartTotal($_SESSION['cart']), 2) ?> PHP</h3>
                    <button type="submit" name="update_cart" class="checkout-btn">Update Cart</button>
                    <button type="button" class="checkout-btn" onclick="window.location.href='checkout.php'">
    Proceed to Checkout
</button>
                </div>
            </form>
        <?php else: ?>
            <div class="empty-cart">
                <p>Your cart is empty.</p>
                <a href="shop.php" class="btn">Continue Shopping</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>