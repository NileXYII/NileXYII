<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vape Shop</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<body>
    <nav class="navigation animate__animated animate__fadeInDown">
        <div class="top-nav">
            <ul>
                <li><a href="#" class="nav-link active">HOME</a></li>
                <li><a href="cart.php" class="nav-link">DISPOSABLE VAPE</a></li>
                <li><a href="#" class="nav-link">POD VAPE KIT</a></li>
                <li><a href="#" class="nav-link">BOXMOD VAPE KIT</a></li>
                <li><a href="contact.php" class="nav-link">CONTACT US</a></li>
                <div class="search-box">
                    <input type="text" placeholder="Search products...">
                </div>
                <div class="auth-buttons">
                    <a href="signup.php" class="btn sign-up">Sign Up</a>
                    <a href="login.php" class="btn login">Login</a>
                </div>
            </ul>
        </div>
    </nav>

    <div class="container animate__animated animate__fadeIn">
        <div class="product-section">
            <img src="images/2.png" alt="CBD Vape Products" class="product-image">
        </div>
        
        <div class="logo-section">
            <img src="images/1.png" alt="Vape Shop Logo" class="logo-image">
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        window.onscroll = function() {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            document.querySelector(".scroll-indicator").style.width = scrolled + "%";
        };
    });
    </script>
</body>
</html>