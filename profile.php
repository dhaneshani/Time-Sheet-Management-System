<?php
include('session.php');
?>
<?php
session_start();
$admin=$_SESSION['admin'];
$user=$_SESSION['user'];
if($admin == "yes"){
    $_SESSION['login_user']=$user;
    header("Location: adminHome.php"); 
    exit;
}else{
    $_SESSION['login_user']=$user;
    header("Location: timeSheetForm.php");  
}
    
unset($_SESSION['admin']); 
unset($_SESSION['user']);




?>