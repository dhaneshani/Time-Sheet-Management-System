<?php
include('session.php');
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="menu2.css" rel="stylesheet" type="text/css">
    <style>
      .logoutLblPos{

         position:fixed;
         right:10px;
         top:5px;
      }
    </style>
     
  </head>

  <body background="image3.jpg">

  <form align="right" name="form1" method="post" action="logout.php">
  <label class="logoutLblPos">
  <input name="logout" type="submit" id="submit2" value="log out">
  </label>
  </form>
  
  <div id="content" align="center">
    
  <ul id="darkmenu">
          <li><a href="module.php">Module Master</a></li>
          <li><a href="empMaster.php">Employee Master</a></li>
          <li><a href="customerMaster.php">Customer Master</a></li>
          <li><a href="workType.php">Work Type</a></li>
          <li><a href="adminFilter.php">View Time Sheet</a></li>
          
     </ul>
  </div>

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

if(isset($_POST['logout'])){

  header('Location: logout.php'); 
  exit;
} 
?>
    

    
  </body>
</html>
