 <?php
 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
   require_once "server/connect.php";
    include('github/init.php');
   include ('server/homeSql.php');
 session_start();
  if( !isset($_SESSION['user_id']) && !isset($_SESSION['git_status'])){
      header("location:index.php");
    }else{
  if (isset($_SESSION['github_email']))
  { 
    //var_dump($_SESSION['github_email']);

  }else{
  $data = fetchData();
  //var_dump($data);
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
 //var_dump($githubUsers);
 if ($githubUsers->num_rows > 0) {
  
  while($row = $githubUsers->fetch_assoc()) {
 
  $_SESSION['displayName'] = $row['displayName'];
               $_SESSION['user_id'] = $row['user_id'];
              $_SESSION['email'] = $row['emailID'];
              $_SESSION['userType'] = $row['usertype'];
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
  //$_SESSION['user_id'] = $row1['user_id'];
  $_SESSION['displayName'] = $row1['displayName'];
               $_SESSION['user_id'] = $row1['user_id'];
              $_SESSION['email'] = $row1['emailID'];
              $_SESSION['userType'] = $row1['usertype'];
 }
 }
 $assignGroups = $sql_service->userGroups($_SESSION['user_id']);
 $result11 = $conn->query($assignGroups);
 $conn->close();

 }
 header("location:Home.php");
 
 }  
 echo $_SESSION;
?>