<?php
include('empMaster.php');
?>
<!DOCTYPE html><html>

<head>
<title>View Employee</title>
</head>

<body background="image1.jpg">

<div id='bottom'>
<?php


$result = sqlsrv_query($conn,"SELECT * FROM empMaster");

// display data in table

echo '<center>';
echo '<p align="center"><h1>Employees</h1></p>';
echo "<table border='1' cellpadding='10' >";

echo "<tr><th>Emp Code</th> <th>Emp Name</th> <th>Designation</th> <th>Emp Type</th><th>User Name</th><th>Admin</th><th></th> <th></th></tr>";



// loop through results of database query, displaying them in the table

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {

// echo out the contents of each row into a table

echo "<tr>";

echo '<td>' . $row['EmpCode'] . '</td>';

echo '<td>' . $row['EmpName'] . '</td>';

echo '<td>' . $row['Designation'] . '</td>';

echo '<td>' . $row['EmpType'] . '</td>';

echo '<td>' . $row['UserName'] . '</td>';

echo '<td>' . $row['Admin'] . '</td>';

echo '<td><a href="updateEmp.php?code=' . $row['EmpCode'] . '">Edit</a></td>';
echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this record?');\" href='deleteEmp.php?code=".$row['EmpCode']."'>Delete</a></td><tr>";

echo "</tr>";
echo '</center>';

}

echo "</table>";

?>
</div>
</body>

</html>

