<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grid Cards</title>
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

</head>
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
<body>
    <div class="grid-container">
        <!-- Repeat this block for each card -->
        <?php for ($i = 0; $i < 12; $i++): ?>
        <div class="grid-item">
            <div class="card-3d-wrap">
                <div class="card-3d-wrapper">
                    <div class="card-front">
                        <div class="pricing-wrap">
                            <h4 class="mb-5">BLACK</h4>
                            <h2 class="mb-2"><sup>PHP</sup>499 / 12:12<sup>COD</sup></h2>
                            <p class="mb-4">lowest price</p>
                            <p class="mb-1"><i class="uil uil-location-pin-alt size-22"></i></p>
                            <p class="mb-4"></p>
                            <a href="#0" class="link">add to cart</a>
                        </div>
                    </div>
                    <div class="card-back">
                        <div class="pricing-wrap">
                            <h4 class="mb-5">Camping</h4>
                            <h2 class="mb-2"><sup>$</sup>29 / 8<sup>hrs</sup></h2>
                            <p class="mb-4">per person</p>
                            <p class="mb-1"><i class="uil uil-location-pin-alt size-22"></i></p>
                            <p class="mb-4">Tara, Serbia</p>
                            <a href="#0" class="link">Choose Date</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endfor; ?>
    </div>
</body>
</html>