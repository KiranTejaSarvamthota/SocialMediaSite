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


if(isset($_POST['get_image']))
{
	if($_POST['img_url']!=""){
 $url=$_POST['img_url'];
 $data = file_get_contents($url);
 $new = 'urlImages/'.rand().'new_image.jpg';
 file_put_contents($new, $data);
 $group_id = $_SESSION['group_id'];
 $user_id = $_SESSION['user_id'];
 echo $group_id.$user_id;
 //echo "<img src='new_image.jpg'>";
 $sql = "INSERT INTO `Web_Programming_2018_AS`.`group_messages` (`group_id`, `messages`, `user_id`) VALUES ('$group_id', '$new', '$user_id');";
if ($conn->query($sql) === TRUE){
	echo $response;
	}
else{
	echo "Error in uploading image";
}
header('Location: Home.php');
}else if(isset($_FILES['upload_file'])){

$filename = $_FILES['upload_file']['name'];
echo $filename;
// Location
$location = 'urlImages/'.$filename;

// file extension
$file_extension = pathinfo($location, PATHINFO_EXTENSION);
$file_extension = strtolower($file_extension);

// Valid image extensions
$image_ext = array("jpg","png","jpeg","gif");
echo $file_extension;
$response = 0;
if(in_array($file_extension,$image_ext)){
	echo $response;
  // Upload file
  if(move_uploaded_file($_FILES['upload_file']['tmp_name'],$location)){
    $userid = $_SESSION['user_id'];
    $response = $location;
    echo $response;
  }
}else{
	$location = 'files/'.$filename;

// file extension
$file_extension = pathinfo($location, PATHINFO_EXTENSION);
$file_extension = strtolower($file_extension); 

	if(move_uploaded_file($_FILES['upload_file']['tmp_name'],$location)){
    $userid = $_SESSION['user_id'];
    $response = $location;
    echo $response;
  }
}
$group_id = $_SESSION['group_id'];
 $user_id = $_SESSION['user_id'];
$sql = "INSERT INTO `Web_Programming_2018_AS`.`group_messages` (`group_id`, `messages`, `user_id`) VALUES ('$group_id', '$response', '$user_id');";
if ($conn->query($sql) === TRUE){
	echo $response;
	}
else{
	echo "Error in uploading image";
}
header('Location: Home.php');
}
}















if(isset($_POST['ProfileImageUpload']))
{
if(isset($_FILES['profile_file'])){

$filename = $_FILES['profile_file']['name'];
echo $filename;
// Location
$location = 'urlImages/'.$filename;

// file extension
$file_extension = pathinfo($location, PATHINFO_EXTENSION);
$file_extension = strtolower($file_extension);

// Valid image extensions
$image_ext = array("jpg","png","jpeg","gif");
echo $file_extension;
$response = 0;
if(in_array($file_extension,$image_ext)){
	echo $response;
  // Upload file
  if(move_uploaded_file($_FILES['profile_file']['tmp_name'],$location)){
    $userid = $_SESSION['user_id'];
    $response = $location;
    echo $response;
  }
}
$group_id = $_SESSION['group_id'];
 $user_id = $_SESSION['user_id'];
$sql = "UPDATE users SET userimg = '$response' WHERE user_id = '$user_id'";
if ($conn->query($sql) === TRUE){
	echo $response;
	}
else{
	echo "Error in uploading image";
}
header('Location: Home.php');
}
	
}






?>