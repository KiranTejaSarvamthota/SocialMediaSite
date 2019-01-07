<?php

include ('connect.php');
include('session.php');

  $sql1="SELECT groups.group_name FROM users_groups INNER JOIN groups ON users_groups.group_id = groups.group_id AND users_groups.user_id = $userId AND groups.archived_status=0";

  $result = $conn->query($sql1);


  $sql2="SELECT * FROM `users` WHERE users.user_id!=$userId";

  $result2 = $conn->query($sql2);


?>





<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Join the groups</title>

<!-- CSS -->
<link rel="stylesheet" href="./css/style_joingrp.css" type="text/css">
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



<form class="myForm" method="post" action="groupinvitation.php">

<p>
<label>Select the group
<select name="invites_group">
	<?php while($row = $result->fetch_assoc()):;?>
	<option><?php echo $row['group_name'];?></option>
    <?php endwhile;?>

</select>
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
      
      
  <?php while($row = $result2->fetch_assoc()):;?>
  	<label for="one">
	<input type="checkbox" name="multipleinvitees[]" value= <?php echo $row['user_id']; ?>><?php echo $row['displayName'];?>  
	</label>
    <?php endwhile;?>

    </div>
  </div>
</p>

<p><button type="submit" class="btn" name="grp_invitation">Submit</button></p>

</form>

<!-- <form class="myForm" method="post" action="groupjoining.php">





<p>
<label>Send Invite to 
<select name="invites_name">

    <?php while($row = $result2->fetch_assoc()):;?>
	<input type="checkbox"><?php echo $row['displayName'];?></input>
    <?php endwhile;?>

</select>
</label>
</p>

<p><button type="submit" class="btn" name="grp_join">Submit</button></p>

</form> -->

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