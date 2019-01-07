<?php

require "init.php";
if(isset($_SESSION['test'])){

}else{
$data = fetchData();
$_SESSION['test']=$data['email']['email'];
}
 echo $_SESSION['test'];
/*if (!isset($_SESSION['user'])) {
    header("location: index.php");
}*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signed In</title>
</head>
<body style="margin-top: 200px; text-align: center;">
    <div>
       
        <a href="logout.php">Log Out</a>
    </div>
</body>
</html>