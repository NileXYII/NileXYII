<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli('localhost', 'username', 'password', 'vape_shop');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $dob = $_POST['dob'];

    $sql = "INSERT INTO users (first_name, middle_name, last_name, email, password, date_of_birth) VALUES ('$first_name', '$middle_name', '$last_name', '$email', '$password', '$dob')";

    if ($conn->query($sql) === TRUE) {
        header('Location: login.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <form method="POST" action="">
            <h2>Sign Up</h2>
            <input type="text" name="first_name" placeholder="First name" required>
            <input type="text" name="middle_name" placeholder="Middle name">
            <input type="text" name="last_name" placeholder="Last name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="date" name="dob" placeholder="Date of Birth" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
