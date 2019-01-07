<?php
include ('connect.php');
session_start();
$id = $_SESSION['group_id'];
$user_id = $_SESSION['user_id'];
$message=test_input($_POST['send_message']);
//$data = $conn->real_escape_string($message);
$data = $conn->real_escape_string($message);
if($data!=""){

$sql = "INSERT INTO `Web_Programming_2018_AS`.`group_messages` (`group_id`, `messages`, `user_id`) VALUES ('$id', '$data', '$user_id')" ;
if ($conn->query($sql) === TRUE){
	header("location:". $_SERVER['HTTP_REFERER']);
}
}else{
	header("location:". $_SERVER['HTTP_REFERER']);
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
