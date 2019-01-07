<?php
$servername = "handson-mysql";
$username = "kumar";
$password = "kumar";
$dbname = "Web_Programming_2018_AS";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
session_start();





$filename = $_FILES['file']['name'];

// Location
$location = 'upload/'.$filename;

// file extension
$file_extension = pathinfo($location, PATHINFO_EXTENSION);
$file_extension = strtolower($file_extension);

// Valid image extensions
$image_ext = array("jpg","png","jpeg","gif");

$response = 0;
if(in_array($file_extension,$image_ext)){
  // Upload file
  if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
    $userid = $_SESSION['user_id'];
    $response = $location;
  }
}
$sql = "UPDATE `Web_Programming_2018_AS`.`users` SET `userimg` = '$response' WHERE `users`.`user_id` = '$userid';";
if ($conn->query($sql) === TRUE){
	echo $response;
	}
else{
	echo "Error in uploading image";
}
?>

