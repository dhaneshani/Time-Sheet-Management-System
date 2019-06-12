<?php
$serverName = "localhost"; 
$connectionInfo = array("Database"=>"SoftwareDepartmentSystem","UID"=>"sa", "PWD"=>"tstc123");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     //echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}

session_start();
$user_check=$_SESSION['login_user'];
$result = sqlsrv_query($conn,"SELECT UserName FROM empMaster where UserName='$user_check' ");
$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
//$ses_sql=mysql_query("select username from login where username='$user_check'", $connection);
//$row = mysql_fetch_assoc($ses_sql);
$login_session =$row['UserName'];
if(!isset($login_session)){
//mysql_close($connection); // Closing Connection
header('Location: index.php'); // Redirecting To Home Page
}
?>