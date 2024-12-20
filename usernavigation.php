<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #dce0c4; /* Matches the navbar's background color */
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
        }

        .navbar a {
            text-decoration: none;
            margin-right: 20px;
            color: #000;
            font-weight: bold;
        }

        .navbar a:hover {
            color: green;
        }

        .navbar .nav-links {
            display: flex;
            align-items: center;
        }

        .navbar .search-bar {
            display: flex;
            align-items: center;
        }

        .navbar input[type="text"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            width: 150px;
        }

        .navbar input[type="text"]:focus {
            outline: none;
            border-color: #888;
        }

        .auth-links {
            margin-left: 20px;
            color: #000;
            font-size: 14px;
        }

        .auth-links a {
            text-decoration: none;
            color: #000;
            margin: 0 10px;
        }

        .auth-links a:hover {
            color: green;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="nav-links">
            <a href="welcome.php">HOME</a>
            <a href="shop.php">DISPOSABLE VAPE</a>
            <a href="shop.php">POD VAPE KIT</a>
            <a href="inbox.php">INBOX</a>
            <a href="orders.php">ORDERS</a>

            <a href="contact-us.php">CONTACT US</a>
            <a href="#">User Profile</a> 
            <a href="land.php" class="logout-btn">LOG OUT</a>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
        </div>
        <div class="auth-links">
            
            </div>
    </div>
</body>
</html>
