<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
//echo $_SESSION['user'];

?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="./css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="./sitescripts/login.js"></script>

<body class="login_body" style="background-image:url(./images/background1.jpeg)">
    <div class="inner-screen">
      <h1 class="user_login">USER LOGIN</h1>
      <div class="form">
        <img src="./images/user.png" alt="User Img">
        <form id = "loginForm" >
        <input type="text" class = "email_txt " name="email" id = "email" placeholder="Enter your email" />
        <input type="password" class="pwd_txt" name="password" id="password" placeholder="Password"/>
        <input type="submit" class="submit_btn" id = "submit" value="Login"/>

        <p></p>
       </form>
       <a class="github" href="github/login.php">Login with Github</a>
       <a class="lost_pwd" href="registration.php">Register?</a>

      </div> 
      <div id = "error"></div>
      <div id = "error1"></div>

    </div> 
    
</body>
</html>