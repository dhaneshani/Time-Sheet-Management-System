<?php
include('module.php');
?>
<!DOCTYPE html><html>
<html >
<head>
    <meta charset="UTF-8">
    <title>View Modules</title>
</head>

<body background="image1.jpg">
    
<div id='bottom'>
<?php

  $result = sqlsrv_query($conn,"SELECT * FROM module");
  echo '<center>';
  echo '<p align="center"><h1>Modules</h1></p>';
  echo "<table border='1' cellpadding='10'>";
  echo "<tr><th>Module Code</th> <th>Module Name</th> <th></th> <th></th></tr>";
  
  while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {

  echo "<tr>";

  echo '<td>' . $row['code'] . '</td>';

  echo '<td>' . $row['name'] . '</td>';

  echo '<td><a href="update.php?code=' . $row['code'] . '">Edit</a></td>';
  echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this record?');\" href='delete.php?code=".$row['code']."'>Delete</a></td><tr>";

  echo "</tr>";

  }

  echo "</table>";      
  echo '</center>';

?>
</div>
</body>

</html>

