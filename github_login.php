<?php
require_once('githubConfig.php');
//require_once('githubApi.php'); 
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
if(isset($_GET['code']))
{
$git = new githubApi($config);
$git->getUserDetails();
$_SESSION['github_data']=$git->getAllUserDetails();
header("location: Home.php");
}
else
{
$url = "https://github.com/login/oauth/authorize?client_id=".$config['client_id']."&redirect_uri=".$config['redirect_url']."&scope=user";
header("Location: $url");
}
}
?>