<?php
session_start();
include_once('connection.php');

// Ensure session variables are set
if (!isset($_SESSION['name']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$name = $_SESSION['name'];
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<?php include 'userdashboard/user-nav.php'; ?>

<head>
    <title>Contact Us - Mabini Vape Shop</title>
    <style>
        /* Sidebar styles */
        .sidebar {
            height: 100vh;
            width: 220px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: gray;
            padding-top: 20px;
            color: black;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            color: black;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        /* Main content */
        .content {
            margin-left: 260px; /* Same as the sidebar width */
            padding: 20px;
        }

        .contact-form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .contact-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .contact-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .contact-form button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #575757;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: black;
        }
    </style>
</head>
<body>
    
    <div class="content">
        <h1>Contact Us</h1>
        <div class="contact-form">
            <h2>We'd love to hear from you!</h2>
            <form method="POST" action="submit_contact.php">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Your Email</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Your Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>
</body>
</html>
