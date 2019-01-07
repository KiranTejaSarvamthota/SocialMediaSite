<?php
   include('connect.php');
   session_start();
   
   if(!isset($_SESSION['user_id'])){
      header("location:loginpage.php");
   }
   $displayName = $_SESSION['displayName'];
   $userId = $_SESSION['user_id'];
?>