<?php
// Sample cart items (In practice, fetch from a session or database)
$cartItems = [
    ["image" => "1.png", "name" => "WeCloud Strawberry", "price" => 200.00, ],
    ["image" => "2.png", "name" => "Poota Lychee", "price" => 400.00, ],
    ["image" => "3.png", "name" => "Black Elite Lemon Cola", "price" => 600.00, ],
    ["image" => "4.png", "name" => "Twst Cool Pomberry", "price" => 500.00, ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Mabini Vape Shop</title>
    <link rel="stylesheet" href="cart.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <!-- Retained Navbar from index.php -->
    <header class="header">
        <div class="logo">
            <img src="images/logo.png" alt="Mabini Vape Shop Logo">
        </div>
        <nav class="nav">
            <a href="index.php">HOME</a>
            <a href="cart.php">DISPOSABLE VAPE</a>
            <a href="#">POD VAPE KIT</a>
            <a href="#">BOXMOD VAPE KIT</a>
            <a href="#">CONTACT US</a>
        </nav>
        <div class="auth-links">
            <a href="#" class="button">Sign Up</a>
            <a href="#" class="button">Login</a>
        </div>
    </header>

    <!-- Cart Section (Product Grid) -->
    <main>
        <section class="cart-container">
            <h1>Products </h1>
            <div class="product-grid">
                <?php foreach ($cartItems as $item): ?>
                <div class="product-card">
                    <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="product-img">
                    <div class="product-details">
                        <h3><?= $item['name'] ?></h3>
                        <p>₱<?= number_format($item['price'], 2) ?></p>
                    </div>
                    <button class="remove-btn">Add to Cart</button>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Cart Summary Section -->
       
    </main>

    <footer class="footer">
        <p>&copy; 2024 Mabini Vape Shop. All rights reserved.</p>
    </footer>
</body>
</html>
