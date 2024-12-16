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

    <style>
        /* Modal Background */
        #ageModal {
            display: block; /* Set to block to show by default */
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            background: white;
            margin: 15% auto;
            padding: 20px;
            width: 80%;
            max-width: 400px;
            text-align: center;
            border-radius: 10px;
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-yes {
            background-color: green;
            color: white;
        }

        .btn-no {
            background-color: red;
            color: white;
        }

        /* Age restriction image */
        .age-img {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>

<?php include 'nav-2.php'; ?>

<body>
    <!-- Age Restriction Modal -->
    <div id="ageModal">
        <div class="modal-content">
            <img src="ch.jpg" alt="Age Restriction" class="age-img">
            <h2>Are you 18 or older?</h2>
            <p>You must be at least 18 years old to access this site.</p>
            <button class="btn btn-yes" onclick="acceptAge()">Yes, I am</button>
            <button class="btn btn-no" onclick="denyAge()">No, I’m not</button>
        </div>
    </div>

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

    <script>
        function acceptAge() {
            // Hide modal and store consent in localStorage
            document.getElementById('ageModal').style.display = 'none';
            localStorage.setItem('ageVerified', 'true');
        }

        function denyAge() {
            alert("You are not allowed to access this site.");
            window.location.href = "https://google.com"; // Redirect to another site
        }

        // Check if age is already verified
        if (localStorage.getItem('ageVerified') === 'true') {
            document.getElementById('ageModal').style.display = 'none';
        }
    </script>
</body>
</html>
