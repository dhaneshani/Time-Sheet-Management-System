<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="css2/style.css">

    
    
    
  </head>

  <body>

    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>


<form id='login' action="" method='post'
    accept-charset='UTF-8' class="STYLE-NAME">
  <h4> Login </h4>
  <input class="name" type="text" name="name" placeholder="Enter Username"/>
  <input class="pw" type="password" name="pw" placeholder="Enter Password"/>
  <input class="button" type="submit" name="Submit" value="Log in"/>
</form>


  </body>
</html>
