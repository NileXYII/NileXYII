<?php
session_start();
include_once('connection.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    if (empty($username) && empty($password)) {
        echo "<script>alert('Please Fill Username and Password');</script>";
        exit;
    } elseif (empty($password)) {
        echo "<script>alert('Please Fill Password');</script>";
        exit;
    } elseif (empty($username)) {
        echo "<script>alert('Please Fill Username');</script>";
        exit;
    } else {
        $sql = "SELECT * FROM `tbl_admin` WHERE `username`=? AND `password`=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['username'] = $row['username'];
            header('Location: welcome.php');
            exit();
        } else {
            echo "<script>alert('Invalid Username or Password');</script>";
            exit();
        }
    }
}
?>