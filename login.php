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
       header("location: Home.php");
      }
    }
   
  }else{
       header("location: loginpage.php");
  }
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>