<?php

 require_once "server/connect.php";
 include('github/init.php');
 include ('server/homeSql.php');
 if(isset($_POST['githubuser'])){
if( !isset($_SESSION['user_id']) && !isset($_SESSION['git_status'])){
      header("location:index.php");
    }else{
  if (isset($_SESSION['github_email']))
  { 
  
  }else{
  $data = fetchData();
  echo $data;
   $github_email=$data['email']['email'];
   $github_username = $data['username'];
   $git_image = "https://avatars.githubusercontent.com/".$github_username;
   
   $_SESSION['github_email'] = $github_email;
   $_SESSION['github_username'] = $github_username;
   $_SESSION['github_image'] = $git_image ;

   }
   $database_connection = new DatabaseConnection();
   $conn = $database_connection->getConnection();
 

 $sql_service = new HomeSqlService();

 $checkGitUser = $sql_service->checkGitUser($_SESSION['github_email']);
 $githubUsers = $conn->query($checkGitUser);
echo $githubUsers;
 if ($githubUsers->num_rows > 0) {
  
  while($row = $githubUsers->fetch_assoc()) {
  $_SESSION['user_id'] = $row['user_id'];
  }
  $conn->close();
 }else{
 $gitNewUser = $sql_service->GitNewUser($_SESSION['github_email'],$_SESSION['github_username'],$_SESSION['github_image']);
 $result = $conn->query($gitNewUser);  
 $checkGitUser1 = $sql_service->checkGitUser($_SESSION['github_email']);
 $githubUsers1 = $conn->query($checkGitUser1);
 //var_dump( $githubUsers1);
 if ($githubUsers1->num_rows > 0) {
 while($row1 = $githubUsers1->fetch_assoc()) {
  $_SESSION['user_id'] = $row1['user_id'];
 }
 }
 $assignGroups = $sql_service->userGroups($_SESSION['user_id']);
 $result11 = $conn->query($assignGroups);
 $conn->close();
 }

 }

}
?>