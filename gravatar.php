
<?php
$email = "saiswaroop.alluri@gmail.com";
$hash = md5( strtolower( trim( $email ) ) );
$size = 150;
$grav_url = "https://www.gravatar.com/avatar/" . $hash . "?s=" . $size;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Display Gravator Image in PHP</title>
</head>
<body>
	<img src="<?php echo $grav_url; ?>">
</body>
</html>