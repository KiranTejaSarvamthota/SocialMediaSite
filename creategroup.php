<?php

include('connect.php');
include('session.php');

  $sql1="SELECT * FROM `users` WHERE users.user_id!=$userId";

  $result = $conn->query($sql1);
  // $options = " ";
  // while($row = $result->fetch_assoc()){
  // 	$options= $options."<option>$row['displayName']</option>";

  // }

?>





<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>My Example</title>

<!-- CSS -->
<link rel="stylesheet" href="./css/style_creategrp.css" type="text/css">


<style>
.multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}

</style>

</head>	
<body>

<form class="myForm" method="post" action="groupcreation.php">

<p>
<label> Group Name
<input type="text" name="group_name" required>
</label> 
</p>

<p>
<label>Purpose 
<input type="tel" name="group_purpose">
</label>
</p>

<p>
  <div class="multiselect">
    <div class="selectBox" onclick="showCheckboxes()">
      <select>
        <option>Select an invitee</option>
      </select>
      <div class="overSelect"></div>
    </div>
    <div id="checkboxes">
      
      
  <?php while($row = $result->fetch_assoc()):;?>
  	<label for="one">
	<input type="checkbox" name="multipleinvitees1[]" value= <?php echo $row['user_id'];?>><?php echo $row['displayName'];?>  
	</label>
    <?php endwhile;?>

    </div>
  </div>
</p>





	
<p>
<label>Group Type
<select id="pickup_place" name="pickup_grp">
<option value="" selected="selected">Select One</option>
<option value="public" >Public</option>
<option value="private" > Private </option>
</select>
</label> 
</p>






<p><button type="submit" class="btn" name="grp_create">Submit</button></p>

</form>

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

</body>
</html>