<?php
require_once "connect.php";
include "loginSql.php";
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
class LoginWebService{
  public function checkLoginCredentials($email_id, $password)
  {
    $database_connection = new DatabaseConnection();
    $conn = $database_connection->getConnection();
    // echo "Hello";
    $sql_service = new LoginSqlService();
    $getUserDetails = $sql_service->getUserDetails($email_id, $password);
    // echo $getUserDetails;
    $result = $conn->query($getUserDetails);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
              $_SESSION['displayName'] = $row['displayName'];
              $_SESSION['user_id'] = $row['user_id'];
              $_SESSION['email'] = $row['emailID'];
              $_SESSION['userType'] = $row['usertype'];
              $array[]= $_SESSION;
              return json_encode($array);
        }
    }else{
      $array['data'] = "nodata";
      return json_encode($array);
    }
    $conn->close();
    //echo $_SESSION['displayName'];
    

  }
}