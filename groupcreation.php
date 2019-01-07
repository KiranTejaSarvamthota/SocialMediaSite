<?php
include('connect.php');
include('session.php');

//die('hello111s');

if(isset($_POST['grp_create'])){  
    $group_name=$conn->real_escape_string($_POST['group_name']);
    //$invites_name=$conn->real_escape_string($_POST['invites_name']);
    //echo $invites_name;
    $pickup_grp=$conn->real_escape_string($_POST['pickup_grp']);

    $sql="INSERT INTO groups(group_name,grp_type) VALUES ('$group_name','$pickup_grp')";
    $conn->query($sql);

  }
 
  $userId = $_SESSION['user_id'];

  $sql1="SELECT * FROM groups WHERE group_name='$group_name' AND grp_type='$pickup_grp'";

  $result = $conn->query($sql1);

    if($result->num_rows >0)
    {
      while($row = $result->fetch_assoc()) 
      {
       $group_id = $row['group_id'];
       $sql2="INSERT INTO users_groups(user_id,group_id) VALUES ('$userId','$group_id')";
       $conn->query($sql2);
       //header('location: Home.php');
      }
    }else{
      $error="Invalid email and password";
    }




  // $sql3="SELECT * FROM groups WHERE group_name='$group_name'";

  // $result1 = $conn->query($sql3);

  //   if($result1->num_rows >0)
  //   {
  //     while($row = $result1->fetch_assoc()) 
  //     {
       $multipleinvitees1=$_POST['multipleinvitees1'];
       foreach($multipleinvitees1 as $mul1){
       $sql4="INSERT INTO users_groups(user_id,group_id) VALUES ('$mul1','$group_id')";
       $conn->query($sql4);

       }

    // }else{
    //   $error="Invalid email and password";
    // }

    header('location: Home.php');

  

?>