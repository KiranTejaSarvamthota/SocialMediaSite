<?php
include("connect.php");
session_start();

$error = " ";
if($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_POST['email']) && isset($_POST['pwd'])) {
    
    $email=$conn->real_escape_string($_POST['email']);
    $password=$conn->real_escape_string($_POST['pwd']);
    $email = test_input($email);
    $password = test_input($password);


    $sql = "SELECT * FROM users where emailID = '$email' and password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows >0)
    {
      while($row = $result->fetch_assoc()) 
      {
       $displayName = $row['displayName'];
       $userId = $row['user_id'];
       $_SESSION['displayName'] = $displayName;
       $_SESSION['user_id'] = $userId;
       header("location: Home.php?id=16&name=global");
      }
    }else{
      $error="Invalid email and password";
    }
  }
  
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="./css/style.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <script src="./sitescripts/login.js"></script>
 <script>
function validate(){
      var email = $('#email').val();
    var password = $('#password').val();
    if(email == "" && password == ""){
      var error = "Please Enter your Email and Password"
      $('#error').text(error); 
      $("#error1").text("");
      return false;
    }else if (email ==""){
      var error = " Please Enter your Email";
       $('#error').text(error);
       $("#error1").text("");  
       return false;   
    }
    else if(password ==""){
      var error = "Please Enter your Password";
       $('#error').text(error);
       $("#error1").text(""); 
       return false;
    } 
}
$(document).ready(function(){
    $("input").keypress(function(){
        $("#error").text("");
        $("#error1").text("");
    });
});

 </script>
</style>
<body class="login_body" >
    <div class="inner-screen">
      <h1 class="user_login">USER LOGIN</h1>
      <div class="form">
        <img src="./images/user.png" alt="User Img">
        <form id = "loginForm"  method="post" onsubmit="return validate()">
        <input type="text" class = "email_txt " name="email" id = "email" placeholder="Enter your email" />
        <input type="password" class="pwd_txt" name="pwd" id="password" placeholder="Password"/>
        <input type="submit" class="submit_btn" id = "submit" value="Login"/>
       </form>

      </div> 
      <div id = "error"></div>
      <div id = "error1"><?php echo $error; ?></div>
    </div> 
    
</body>
</html>
  