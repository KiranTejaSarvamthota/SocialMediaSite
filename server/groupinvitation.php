<?php
  include('connect.php');
  include('session.php');

//die('hello111s');

// if(isset($_POST['grp_invitation'])){  
    
//     $invites_group=$conn->real_escape_string($_POST['invites_group']);
//     echo "kiran1";

//   }
function test_input($data) {

  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_POST['grp_invitation'])){  
    echo $_POST['invites_group'];
    $invites_group=$conn->real_escape_string($_POST['invites_group']);
    echo $invites_group;
    $invites_group = test_input($invites_group);

    echo $invites_group;
    die();
    $sql3="SELECT * FROM groups WHERE group_name=$invites_group";


   echo $sql3;
   

    $result = $conn->query($sql3);

    if($result_new = $result->num_rows >0)
    {
      while($row = $result->fetch_assoc()) 
      {
       $invitegrpid = $row['group_id'];
        $multipleinvitees=$_POST['multipleinvitees'];
        foreach ($multipleinvitees as $mul) {
       $sql4="INSERT INTO users_groups(user_id,group_id) VALUES ('$mul','$invitegrpid')";
       $conn->query($sql4);
       
          # code...
        }

       
      }
    }else{
      $error="Invalid email and password";
    }
    //header('location: Home.php');

  }
 



  // $sql3="SELECT * FROM groups WHERE group_name='$invites_group'";

  // $result = $conn->query($sql3);

  //   if($result->num_rows >0)
  //   {
  //     while($row = $result->fetch_assoc()) 
  //     {
  //      $invitegrpid = $row['group_id'];
  //      $sql4="INSERT INTO users_groups(user_id,group_id) VALUES ('$userId','$invitegrpid')";
  //      $conn->query($sql4);
  //      header('location: Home.php');
  //     }
  //   }else{
  //     $error="Invalid email and password";
  //   }

  

?>