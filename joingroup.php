<?php

include ('connect.php');
include('session.php');

  $sql1="SELECT  DISTINCT group_name from groups where grp_type = 'public' AND  archived_status=0 AND group_name NOT IN (SELECT groups.group_name from users_groups,groups where users_groups.group_id = groups.group_id AND users_groups.user_id = $userId)";

  $result = $conn->query($sql1);


// SELECT groups.group_id
// FROM groups
// INNER JOIN users_groups ON groups.group_id=users_groups.group_id;

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
<style></style>

</head>	
<body>

<form class="myForm" method="post" action="groupjoining.php">



<p>
<label>Select the group
<select name="invites_group">
	<?php while($row = $result->fetch_assoc()):;?>
	<option><?php echo $row['group_name'];?></option>
    <?php endwhile;?>

</select>
</label>
</p>

<p><button type="submit" class="btn" name="grp_join">Submit</button></p>

</form>

</body>
</html>