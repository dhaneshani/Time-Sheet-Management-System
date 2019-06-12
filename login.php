<?php 
session_start(); 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$serverName = "localhost"; 
$connectionInfo = array("Database"=>"SoftwareDepartmentSystem","UID"=>"sa", "PWD"=>"tstc123");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     //echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['Submit'])){
  $name=$_POST['name'];
  $pw_1=$_POST['pw'];
  $pw=sha1($pw_1);

  $query = "SELECT * FROM empMaster WHERE UserName='$name' AND Password='$pw'";
  $result = sqlsrv_query($conn,$query);
  $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
  $admin=$row['Admin'];
  if(count($row) != 0){
    session_start();
    $_SESSION['admin'] = $admin;
    $_SESSION['user'] = $name;
    header("Location:profile.php");
    exit(); 
  }else{
     echo "
            <script type=\"text/javascript\">
            alert('Enter valid usernama and passworrd !!');
            </script>
        ";
    }
    
}
?>