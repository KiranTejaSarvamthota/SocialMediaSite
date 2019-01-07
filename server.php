<?php
//echo "hello";
include("connect.php");
session_start();


// initializing variables
$username = "";
$email    = "";
$errors = array(); 
$fname="Hi";
$sname="hello";

// connect to the database

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username=$conn->real_escape_string($_POST['username']);
  $email=$conn->real_escape_string($_POST['email']);
  $password_1=$conn->real_escape_string($_POST['password_1']);
  $password_2=$conn->real_escape_string($_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
  array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  
  $user_check_query = "SELECT * FROM users WHERE displayName='$username' OR emailID='$email' LIMIT 1";
  $result = $conn->query($user_check_query);
  if($result->num_rows >0){
  while($user = $result->fetch_assoc()){
    
    if ($user) { // if user exists
    if ($user['displayName'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['emailID'] === $email) {
      array_push($errors, "email already exists");
    }
  }
  }
}



//
    function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6LeLQ30UAAAAAI7XFgm_uRcu4kwjLbKh8nl3D-JW',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response']);

    if (!$res['success']) {
       array_push($errors, "Please go back and make sure you check the security CAPTCHA box.");

        // What happens when the CAPTCHA wasn't checked
        //echo '<p>Please go back and make sure you check the security CAPTCHA box.</p><br>';
      //$message="invalid attempt";
      //echo "<script type='text/javascript'>alert('$message');</script>";
    } else {





        // If CAPTCHA is successfully completed...

        // Paste mail function or whatever else you want to happen here!
        //echo '<br><p>CAPTCHA was completed successfully!</p><br>';
       
      //include('server.php');
      if (count($errors) == 0) {

$hash = md5( strtolower( trim( $email ) ) );
$size = 150;
$grav_url = "https://www.gravatar.com/avatar/" . $hash . "?s=" . $size;
    //$password = md5($password_1);//encrypt the password before saving in the database

        $sql = "INSERT INTO users (firstName,lastName,displayName, emailID, password,userimg) VALUES(' ',' ','$username', '$email', '$password_1','$grav_url')";
        $conn->query($sql) ;


        $sql_userid = "SELECT * from users where emailID = '$email'";
        $result = $conn->query($sql_userid);
        while($row=$result->fetch_assoc()){
           $user_id = $row['user_id'];
        }
        $global_insert = "INSERT INTO users_groups (user_id,group_id) VALUES ('$user_id','16')";
        $data = $conn->query($global_insert);
        
        $_SESSION['displayName'] = $username;
        $_SESSION['success'] = "You are now logged in";

        header('location: index.php');


      }

  }
  


}




?>