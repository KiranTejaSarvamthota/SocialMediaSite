<?php

   require_once "server/connect.php";
   include('connect.php');
   include('upload_image.php');
   include('github/init.php');
   include ('server/homeSql.php');
   //session_start();
   



   
  /* if( !isset($_SESSION['user_id']) && !isset($_SESSION['git_status'])){
      header("location:index.php");
    }else{
  if (isset($_SESSION['github_email']))
  { 
    //var_dump($_SESSION['github_email']);

  }else{
  $data = fetchData();
  var_dump($data);
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
 echo "hello";
 }  */

?>
 
<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Spectral" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="./css/style_home.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="./sitescripts/Home.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">

var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
  

</script>
  
  <link rel="stylesheet" type="text/css" href="./css/style_home.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<!-- <nav > 
    <h1 id="grouptitle" style="float:left"> #global</h1>
    <div id = "title" style=" width:50%; float:left;">
    </div> 
    <div style="float:right; margin-right: 300px; margin-top: 20px;">
        <input  type="text" name="search" id="search" placeholder="Search">
        <div     style="background: aquamarine;" id="result"></div>
    </div>



</nav> -->
<body id="home">
<div class ="row"> 
<div class="sidebar col-sm-2">
  <a id = "name"> <?php echo $_SESSION['user_id']; ?></a>
  <h1 class = "title"> Groups </h1>
  <div id = "groups"> 
  </div>
<a id = "account_details" data-toggle="modal" data-target="#uploadModal" class = "profile" >My Account</a>
<div id = "creategroups"> 

  <a data-toggle="modal" data-target="#create_group" >Create Group <i class="fa fa-plus"></i></a>

</div>

<div id = "joingroups"> 

  <a  href="./joingroup.php">Join Group <i class="fa fa-plus"></i></a>

</div>

<div id = "invitetogroups"> 

  <a  href="./invitetogroup.php">Invite to the Group <i class="fa fa-plus"></i></a>

</div>

<div id = "2FA"> 

  <a  href=" ">Enable 2FA<i class="fa fa-plus"></i></a>

</div>
<h1 class = "title"> Direct Messages </h1>
  <div id = "directmessages"> 
  </div>

<a id = "logout"  href = "./logout.php">Logout</a>
</div>


<div class="content col-sm-10">
  <div  style="height:50px; "> 
    <h1 id="grouptitle" style="float:left"> #global</h1>
    <div id = "title" style=" float:left">

    </div>


 <div id = "usersinfo" style="display: inline;margin-left: 40px; ">Hello</div>
 <div id = "messagessinfo" style="display: inline;">Hello</div> 
<i class="fa fa-search searchUsers" style="    font-size: 30px;
    float: right;
    margin: 10px;"></i>
 <i class="fa fa-question-circle" id ="helpPage" style="font-size:36px; float: right;padding: 10px;"></i>
</div>
  <div id="messages">

  </div>
  <div id="messageinput_div">
      
        <div class="dropup">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Add
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
    <li><a data-toggle="modal" data-target="#uploadImageModal" id="uploadImage">Image Upload</a></li>
    <li><a data-toggle="modal" data-target="#codeModal" id='insertCode'>Insert Code</a></li>
    
  </ul>
</div>
      <input type="text" placeholder="Enter Message" name="send_message" id="send_message"/>
      <input type="submit"  id="post_message" value="Post" />
   
</div>
  </div> 
  <div class=" searchDiv" style="overflow: auto;">
    <div style="  margin-top: 20px;">
        <input  style="width:90%;"  type="text" name="search" id="search" placeholder="Search">
        <div     style="width:90%; font-size: 20px; background: aquamarine;" id="result"></div>
    </div>
    <div class="UserDetails" >
  </div>
  <div id = "graphs">
  </div>
 
</div>



<div id="uploadImageModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Image</h4>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <form method='post' action='upload_image.php' enctype="multipart/form-data">
          Select file : <input type='file' name="upload_file" id='upload_file' class='form-control' ><br>
            <input type="text" name="img_url" placeholder="Enter Image URL">
            <input type="submit" name="get_image" id = 'image_submit' value="Submit">
          </form>
        </div>

        <!-- Preview-->
        <div id='preview_image'></div>
      </div>
 
    </div>

  </div>
</div>

<div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Profile Picture</h4>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <form method='post' action='upload_image.php' enctype="multipart/form-data">
          Select file : <input type='file' name='profile_file' id='profile_image' class='form-control' ><br>
          <input type='submit' class='btn btn-info' value='Upload' name='ProfileImageUpload' id='upload_profile_picture'>
          <input type='button' class='btn btn-info' value='Use Gravatar' name='gravatar' id='gravatar'>
        </form>

        <!-- Preview-->
        <div id='preview_profile'></div>
      </div>
 
    </div>

  </div>
</div>


<div id="codeModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Code input</h4>
      </div>
      <div class="modal-body">
        <textarea style=" width: 100%;height: 300px;"id ="codesnippet"></textarea>
        <input type='button' class='btn btn-info' value='Submit Code' id='codeInsert'>
      </div>
 
    </div>

  </div>
</div>



<!-- CREATE GROUPS MODALS-->


<div id="groupMemberShip" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Group MemberShip</h4>
      </div>
      <div class="modal-body">
        <div id = "members">

        </div>      
      </div>
 
    </div>

  </div>
</div>



<div id="create_group" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">Create Group</h2>
      </div>
      <div class="modal-body">
        <!-- Form -->
       <form class="myForm" method="post" action="groupcreation.php">

<p>
<label> Group Name:
<input type="text" name="group_name" required>
</label> 
</p>

<p>
  <div class="multiselect">
    <div class="selectBox" onclick="showCheckboxes()">
      <label> Users:
      <select id="newUsers">    
        <option>Select an invitee</option>
      </select>
       </label>
      <div class="overSelect"></div>
    </div>
    <div id="checkboxes">
      <label id ="usersCheckBox" for="one">
      </label>
       </div>
  </div>
<label>Group Type
<select id="pickup_place" name="pickup_grp">
<option value="" selected="selected">Select One</option>
<option value="public" >Public</option>
<option value="private" > Private </option>
</select>
</label> 
<button type="submit" class="btn" name="grp_create">Submit</button>
</form>

      </div>
 
    </div>

  </div>
</div>
</div>


</body>
</html>
