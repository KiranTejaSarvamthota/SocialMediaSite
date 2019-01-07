<?php
include ('connect.php');
include('session.php');

if(isset($_POST['grp_join'])){  
    
    $invites_group=$conn->real_escape_string($_POST['invites_group']);

  }
 



  $sql3="SELECT * FROM groups WHERE group_name='$invites_group'";

  $result = $conn->query($sql3);

    if($result->num_rows >0)
    {
      while($row = $result->fetch_assoc()) 
      {
       $invitegrpid = $row['group_id'];
       $sql4="INSERT INTO users_groups(user_id,group_id) VALUES ('$userId','$invitegrpid')";
       $conn->query($sql4);
       header('location: Home.php');
      }
    }else{
      $error="Invalid email and password";
    }

  

?>