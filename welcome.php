<?php
session_start();
include_once('connection.php');

// if(isset($_SESSION['name']) && isset($_SESSION['username'] )){

// }
$_SESSION['name'];
$_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="welcome.css">

</head>
<body>
      <!-- Start Landing Page -->
      <div class="landing-page">
        <header>
          <div class="container">
            <a href="#" class="logo">Mate's <b>Playground</b></a>
            <ul class="links">
              <li>Home</li>
              <li>Products</li>
              <li>Vape Gallery</li>
              <li>Info</li>
              <li>Cpntact Us </li>
            </ul>
          </div>
        </header>
        <div class="content">
          <div class="container">
            <div class="info">
              <h1>See you next week niggas</h1>
<p>Commit with UI/UX DB</p>
              <button> P Diddy's Dashboard</button>
            </div>
            <div class="image">
              <img src="logo.png">
            </div>
          </div>
        </div>
      </div>
      <!-- End Landing Page -->
<!-- partial -->
  <script  src="welcome.js"></script>

</body>
</html>
