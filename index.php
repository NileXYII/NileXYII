<?php
// PHP can be used for dynamic functionality (e.g., fetch products from a database).
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mabini Vape Shop</title>
    <!-- Link to External CSS -->
    <link rel="stylesheet" href="styles.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="2.png" alt="Mabini Vape Shop Logo">
        </div>
        <nav class="nav">
            <a href="index.php">HOME</a>
            <a href="cart.php">DISPOSABLE VAPE</a>
            <a href="#">POD VAPE KIT</a>
            <a href="#">BOXMOD VAPE KIT</a>
            <a href="#">CONTACT US</a>
        </nav>
        <div class="auth-links">
            <a href="register.php" class="button">Sign Up</a>
            <a href="land.php" class="button">Login</a>
        </div>
    </header>
    <main>
        <section class="hero">
            <h1>Welcome to Mabini Vape Shop</h1>
            <p>Your one-stop shop for premium vape products.</p>
        </section>
        <section class="product-display">
            <div class="product-card">
                <img src="5.png" alt="Product 1">
               
              
            </div>
            <div class="product-card">
                <img src="logo.png" alt="Product 2">
               
            </div>
            <div class="product-card">
                <img src="3.png" alt="Product 3">
                
            </div>
        </section>
    </main>
    <footer class="footer">
        <p>&copy; 2024 Mabini Vape Shop. All rights reserved.</p>
    </footer>
</body>
</html>
