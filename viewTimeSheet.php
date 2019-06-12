<?php
include('session.php');
?>
<!DOCTYPE html><html>

<head>

<meta charset="UTF-8">
    <title>View Work Types</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/normalize.css">

    
    <link rel="stylesheet" href="css/style.css">

    <link href="menu.css" rel="stylesheet" type="text/css">
    <script src="sample-registration-form-validation.js"></script>
    <style>
	.logoutLblPos{
	position:fixed;
	right:10px;
	top:5px;
	}
	</style>

</head>

<body background="image1.jpg">
<form align="right" name="form1" method="post" action="logout.php">
  <label class="logoutLblPos">
  <input name="logout" type="submit" id="submit2" value="log out">
  </label>
</form>
<div id="content">
  <ul id="darkmenu">
          <li><a href="module.php">Module Master</a></li>
          <li><a href="empMaster.php">Employee Master</a></li>
          <li><a href="customerMaster.php">Customer Master</a></li>
          <li><a href="workType.php">Work Type</a></li>
          <li><a href="viewTimeSheet.php">View Time Sheet</a></li>
          
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

$result = sqlsrv_query($conn,"SELECT * FROM timeSheet");

// display data in table

echo '<center>';
echo '<p align="center"><h1>Time Sheet</h1></p>';
echo "<table border='1' cellpadding='10'>";

echo "<tr><th>Date</th> <th>Customer</th><th>Module</th><th>Work Type</th><th>Description</th><th>Start Time</th><th>End Time</th><th>Duration</th></tr>";



// loop through results of database query, displaying them in the table

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {



// echo out the contents of each row into a table

echo "<tr>";

echo '<td>' . $row['Day'] . '</td>';

echo '<td>' . $row['Customer'] . '</td>';

echo '<td>' . $row['Module'] . '</td>';

echo '<td>' . $row['WorkType'] . '</td>';

echo '<td>' . $row['Description'] . '</td>';

echo '<td>' . $row['StartTime'] . '</td>';

echo '<td>' . $row['EndTime'] . '</td>';

echo '<td>' . $row['Duration'] . '</td>';

echo "</tr>";

}



// close table>

echo "</table>";
echo '</center>';



if(isset($_POST['logout'])){
  header('Location: logout.php'); 
  exit;
} 
?>
</body>
</html>