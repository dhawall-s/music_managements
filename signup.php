<?php
require 'auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (signup($username, $email, $password)) {
        header('Location: login.php');
    } else {
        $error = "Signup failed. Try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIGN UP FORM </title>
  <link rel="stylesheet" href="login.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<video autoplay loop muted id="background-video">
    <source src="No Copyright Video, Background, Green Screen, Motion Graphics, Animated Background, Copyright Free.mp4" type="video/mp4">
  </video>
  <div class="wrapper">
    <form action="signup.php" method="POST">
      <h1>signUp</h1>
      <div class="input-box">
        <input type="text" name="username" placeholder="Username" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="email" name="email" placeholder="Email" required>
        <i class='bx bxs-lock-alt' ></i>
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="Password" required>
        <i class='bx bxs-lock-alt' ></i>
      </div>
      <button type="submit" class="btn">SIGN UP</button>
      <div class="register-link">
        <p>HAVE AN ACCOUNT <a href="login.php">LOGIN NOW</a></p>
      </div>
    </form>
    <?php if (isset($error)) echo $error; ?>
  </div>
</body>
</html>







