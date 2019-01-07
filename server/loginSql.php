<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
class LoginSqlService{
    public $sql = "";
    public function getUserDetails($email_id, $password) {
      $sql = "SELECT * FROM `Web_Programming_2018_AS`.`users` where emailID = '$email_id' and password='$password'";
      return $sql;
    }
}
?>
