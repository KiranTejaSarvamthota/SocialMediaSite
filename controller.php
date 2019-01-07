<?php
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);
  session_start();
  include_once "loginService.php";
  include_once "HomeService.php";
  $loginWebService = new LoginWebService();
  $HomeWebService = new HomeWebService();

    if(isset($_POST["login"])){
        $login = $conn->real_escape_string($_POST['login']);
        $email = $conn->real_escape_string($login['email']);
        $password = $login['password'];
        $login=$loginWebService->checkLoginCredentials($email, $password);
        echo $login;
    }

    if(isset($_POST['groupslist'])){
    	$userId = $_SESSION['user_id'];
    	$groups = $HomeWebService->getGroups($userId);
    	echo json_encode($groups);
    }

    if(isset($_POST['groupMessages'])){
    	$groupId = $_POST['groupMessages'];
    	$_SESSION['group_id'] = $groupId;
    	$group_messages = $HomeWebService->getGroupMessages($groupId);
    	echo json_encode($group_messages);
    }

    if(isset($_POST['post_message'])){
    	$post_message = $_POST['post_message'];
    	$groupId = $_SESSION['group_id'];
    	$userId = $_SESSION['user_id'];
    	$post_messages = $HomeWebService->postMessages($post_message,$groupId,$userId);
    	echo json_encode($post_messages);
    }

    if(isset($_POST['reactions']) && isset($_POST['message_id'])){
    	$userId = $_SESSION['user_id'];
    	$reactions = $_POST['reactions'];
    	$message_id = $_POST['message_id'];
    	$set_reaction = $HomeWebService->setReaction($reactions,$message_id,$userId);
    	echo $reactions;
    	echo json_encode($set_reaction);
    }

    if(isset($_POST['group_id'])){
    	$group_id = $_POST['group_id'];
    	$userId = $_SESSION['user_id'];
    	$get_reaction = $HomeWebService->getReaction($group_id,$userId);
    	echo json_encode($get_reaction);
    }

    if(isset($_POST['groupid_comments'])){
    	$groupId = $_POST['groupid_comments'];
    	$get_comments = $HomeWebService->getComments($groupId);
    	echo json_encode($get_comments);
    }



    if(isset($_POST['messageId']) && isset($_POST['comment'])){
        $userId = $_SESSION['user_id'];
        $messageId = $_POST['messageId'];
        $comment = $_POST['comment'];
        $groupId = $_SESSION['group_id'];
        $post_comments = $HomeWebService->postComments($userId,$messageId,$comment,$groupId);
        echo json_encode($post_comments);
      
    }

    if(isset($_POST['getuserslist'])){
        $getuserslist = $HomeWebService->getuserslist();
        echo json_encode($getuserslist);
    }

  
    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
        $getuserslist = $HomeWebService->getUsersDetails($user_id);
        echo json_encode($getuserslist);
    }



    









    if(isset($_FILES["file"]["type"]))
{
$validextensions = array("jpeg", "jpg", "png");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
if ($_FILES["file"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
}
else
{
if (file_exists("upload/" . $_FILES["file"]["name"])) {
echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
}
else
{
$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
$targetPath = "upload/".$_FILES['file']['name']; // Target path where file is to be stored
move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
}
}
}
else
{
echo "<span id='invalid'>***Invalid file Size or Type***<span>";
}
}

?>    

