<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="css/register.css">
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <!-- <script  src="../../Jquery/prettify.js"></script> -->
</head>

<body>
  <div class="header">
    <h2>Register</h2>
  </div>
  
  <form method="post" action="registration.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
      <label>Username</label>
      <input type="text" name="username" value="<?php echo $username; ?>">
    </div>
    <div class="input-group">
      <label>Email</label>
      <input type="email" name="email" value="<?php echo $email; ?>">
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="password" name="password_1">
    </div>
    <div class="input-group">
      <label>Confirm password</label>
      <input type="password" name="password_2">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="reg_user">Register</button>
    </div>
    <div class="g-recaptcha" data-sitekey="6LeLQ30UAAAAABOUUanYcf3QXDFg5yQFkFMy_p5p"></div>

    <p>
      Already a member? <a href="index.html">Sign in</a>
    </p>
  </form>
</body>
</html>