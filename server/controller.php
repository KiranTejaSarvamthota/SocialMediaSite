<?php
  require_once "connect.php";
 
  //session_start();
  include_once "../github/init.php";
  //include ('homeSql.php');
  include_once "loginService.php";
  include_once "HomeService.php";
  $loginWebService = new LoginWebService();
  $HomeWebService = new HomeWebService();
  $sql_service = new HomeSqlService();
 

function test_input($data) {

  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();



    if(isset($_POST['getuserslistd'])){
        $userId = $_SESSION['user_id'];
        $getuserslistd = $HomeWebService->getuserslistd($userId);
        echo json_encode($getuserslistd);
    }
    //kiran
    if(isset($_POST['userslistdm'])){
        $userId = $_SESSION['user_id'];
        $usertype = $_SESSION['userType'];
        $groups = $HomeWebService->getuserslistdm($userId,$usertype);
        echo json_encode($groups);
    }

    //kiran
    if(isset($_POST['directMessages'])){
        $chatId = $conn->real_escape_string($_POST['directMessages']);
        $chatId = test_input($chatId);
        $_SESSION['chat_id'] = $chatId;
        $userId = $_SESSION['user_id'];
        $direct_messages = $HomeWebService->getDirectMessages($chatId,$userId);
        echo json_encode($direct_messages);
    }

     //kiran
    if(isset($_POST['post_messaged'])){
        $post_messaged = test_input($_POST['post_messaged']);
        $post_messaged = $conn->real_escape_string($post_messaged);
        //$chatId = $_SESSION['chat_id'].$_SESSION['user_id'];
        $chatId = $_SESSION['chat_id'];
        $groupId = $_SESSION['group_id'];
        $userId = $_SESSION['user_id'];
        $post_messagesd = $HomeWebService->postMessagesd($post_messaged,$chatId,$userId);
        echo json_encode($post_messagesd);
    }

    if(isset($_POST['gravatar'])){
        $email = $_SESSION['email'];
        $hash = md5( strtolower( trim( $email ) ) );
        $size = 150;
        $grav_url = "https://www.gravatar.com/avatar/" . $hash . "?s=" . $size;
        $gravatar = $HomeWebService->getGravatar($grav_url,$email);
        echo $gravatar;
    }
    if(isset($_POST["login"])){
        $login = $_POST['login'];
        $email = $login['email'];
        $password = $login['password'];
        $login=$loginWebService->checkLoginCredentials($email, $password);
        echo $login;
    }

    if(isset($_POST['groupslist'])){
    	$userId = $_SESSION['user_id'];
        $usertype = $_SESSION['userType'];
    	$groups = $HomeWebService->getGroups($userId,$usertype);
    	echo json_encode($groups);
    }

    if(isset($_POST['groupMessages'])){
    	$groupId = $conn->real_escape_string($_POST['groupMessages']);
        $groupId = test_input($groupId);
    	$_SESSION['group_id'] = $groupId;
    	$group_messages = $HomeWebService->getGroupMessages($groupId);
    	echo json_encode($group_messages);
    }

    if(isset($_POST['post_message'])){
        $post_message = test_input($_POST['post_message']);
    	$post_message = $conn->real_escape_string($post_message);
        
    	$groupId = $_SESSION['group_id'];
    	$userId = $_SESSION['user_id'];
    	$post_messages = $HomeWebService->postMessages($post_message,$groupId,$userId);
    	echo json_encode($post_messages);
    }


    if(isset($_POST['code']) && isset($_POST['codetext'])){
        $post_message = test_input($_POST['code']);
        $post_message = $conn->real_escape_string($post_message);
        $codetext = $_POST['codetext'];
        
        $groupId = $_SESSION['group_id'];
        $userId = $_SESSION['user_id'];
        $post_messages = $HomeWebService->postMessageswithCode($post_message,$groupId,$userId,$codetext);
        echo json_encode($post_messages);
    }



    if(isset($_POST['reactions']) && isset($_POST['message_id']) && isset($_POST['likes']) && isset($_POST['dislikes'])){
    	$userId = $_SESSION['user_id'];
    	$reactions = $conn->real_escape_string($_POST['reactions']);
    	$message_id = $conn->real_escape_string($_POST['message_id']);
        $likes = $conn->real_escape_string($_POST['likes']);
        $dislikes = $conn->real_escape_string($_POST['dislikes']);
        $reactions = test_input($reactions);
        $message_id = test_input($message_id);
        $likes = test_input($likes);
        $dislikes = test_input($dislikes);
    	$set_reaction = $HomeWebService->setReaction($reactions,$message_id,$userId,$likes,$dislikes);
    	echo $reactions;
    	echo json_encode($set_reaction);
    }

    if(isset($_POST['group_id'])){
    	$group_id = $conn->real_escape_string($_POST['group_id']);
        $group_id = test_input($group_id);
    	$userId = $_SESSION['user_id'];
    	$get_reaction = $HomeWebService->getReaction($group_id,$userId);
    	echo json_encode($get_reaction);
    }

    if(isset($_POST['group_id']) && isset($_POST['user_id'])){
        $group_id = $conn->real_escape_string($_POST['group_id']);
        $group_id = test_input($group_id);
        $userId = $_POST['user_id'];
        $get_reaction = $HomeWebService->getReaction($group_id,$userId);
        echo json_encode($get_reaction);
    }

    if(isset($_POST['groupid_comments'])){
    	$groupId = $conn->real_escape_string($_POST['groupid_comments']);
        $groupId = test_input($groupId);
    	$get_comments = $HomeWebService->getComments($groupId);
    	echo json_encode($get_comments);
    }



    if(isset($_POST['messageId']) && isset($_POST['comment'])){
        $userId = $_SESSION['user_id'];
        $messageId = test_input($_POST['messageId']);
        $comment = test_input($_POST['comment']);
        $messageId = $conn->real_escape_string($messageId);
        $comment = $conn->real_escape_string($comment);
        
        /*echo $comment.$userId.$messageId.$groupId;
        die();*/
        $groupId = $_SESSION['group_id'];
        $post_comments = $HomeWebService->postComments($userId,$messageId,$comment,$groupId);
        echo json_encode($post_comments);
      
    }

    if(isset($_POST['getuserslist'])){
        $getuserslist = $HomeWebService->getuserslist();
        echo json_encode($getuserslist);
    }

  
    if(isset($_GET['user_id'])){
        $user_id = $conn->real_escape_string($_GET['user_id']);
        $user_id = test_input($user_id);
        $getuserslist = $HomeWebService->getUsersDetails($user_id);
        echo json_encode($getuserslist);
    }

    if(isset($_POST['deleteMessage'])){
        $deleteMessageId = $conn->real_escape_string($_POST['deleteMessage']);
        $deleteMessageId = test_input($deleteMessageId);
        $deleteMessage = $HomeWebService->deleteMessage($deleteMessageId);
        echo $deleteMessage;
    }

    if(isset($_POST['newGroupUsers'])){
        $user_id = $_SESSION['user_id'];
        $getUsersForNewGroup = $HomeWebService->getUsersForNewGroup($user_id);
        echo json_encode($getUsersForNewGroup);
    }

    if(isset($_POST['archive_id']) && isset($_POST['archive_value'])){
        $archive_id = $_POST['archive_id'];
        $archive_value = $_POST['archive_value'];
        $setArchive = $HomeWebService->setArchive($archive_id,$archive_value);
        echo json_encode($setArchive);
    }

    if(isset($_POST['archived_status'])){
        $usertype = $_SESSION['userType'];
        $archive_id = $_POST['archived_status'];
        $getArchive = $HomeWebService->getArchive($archive_id,$usertype);
        echo json_encode($getArchive);
    }

    if(isset($_POST['query'])){
        $search = $conn->real_escape_string($_POST['query']);
        $search = test_input($search);
        $getSearchResults = $HomeWebService->getSearchResults($search);
        echo json_encode($getSearchResults);
    }

    if(isset($_POST['reactionCount'])){
        $reactionCount = $conn->real_escape_string($_POST['reactionCount']);
        $reactionCount = test_input($reactionCount);
        $getReactionCount = $HomeWebService->getReactionCount($reactionCount);
        echo json_encode($getReactionCount);
    }

    if(isset($_POST['numberOfUsers'])){
        $numberOfUsers = $conn->real_escape_string($_POST['numberOfUsers']);
        $numberOfUsers = test_input($numberOfUsers);
        $getNumberOfUsers = $HomeWebService->getNumberofUsers($numberOfUsers);
        echo json_encode($getNumberOfUsers);
    }

    if(isset($_POST['deleteUsers'])){
        $deleteUsers = $conn->real_escape_string($_POST['deleteUsers']);
        $deleteUsers = test_input($deleteUsers);
        $getUpdatedUsers = $HomeWebService->deleteUsers($deleteUsers);
        echo json_encode($getUpdatedUsers);
    }

    if(isset($_POST['usertype'])){
        $usertype = $_SESSION['userType'];
        echo $usertype;    
    }

    if(isset($_POST['numberOfUsersFormetrics']) && isset($_POST['user_id'])){
        $deleteUsers = $conn->real_escape_string($_POST['numberOfUsersFormetrics']);
        $deleteUsers = test_input($deleteUsers);
        $numberOfUsers = $conn->real_escape_string($_POST['user_id']);
        $numberOfUsers = test_input($numberOfUsers);
        $getUpdatedUsers = $HomeWebService->numberOfUsersFormetrics($deleteUsers,$numberOfUsers);
        echo json_encode($getUpdatedUsers);
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

