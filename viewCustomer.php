<?php
include('customerMaster.php');
?>

<!DOCTYPE html><html>
<head>
  <meta charset="UTF-8">
  <title>View Customers</title>
</head>

<body background="image1.jpg">

<div id='bottom'>
<?php


$result = sqlsrv_query($conn,"SELECT * FROM customerMaster");

// display data in table

echo '<center>';
echo '<p align="center"><h1>Customers</h1></p>';
echo "<table border='1' cellpadding='10' >";

echo "<tr><th>Customer Code</th> <th>Customer Name</th> <th>Address</th> <th>Contact Name</th> <th>Contact No</th> <th></th> <th></th></tr>";



// loop through results of database query, displaying them in the table

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {

// echo out the contents of each row into a table

echo "<tr>";

echo '<td>' . $row['CustomerCode'] . '</td>';

echo '<td>' . $row['CustomerName'] . '</td>';

echo '<td>' . $row['Address'] . '</td>';

echo '<td>' . $row['ContactName'] . '</td>';

echo '<td>' . $row['ContactNo'] . '</td>';

echo '<td><a href="updateCustomer.php?code=' . $row['CustomerCode'] . '">Edit</a></td>';
echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this record?');\" href='deleteCustomer.php?code=".$row['CustomerCode']."'>Delete</a></td><tr>";

echo "</tr>";
echo '</center>';

}

echo "</table>";
  
?>
</div>
</body>

</html>

