<?php
include('session.php');
include('adminMenu.php');
ob_start();
?>

<html>
<head>
  <meta charset="UTF-8">
  <title>Update Customers</title>
</head>

<body background="image1.jpg">

  <div class="form-style-10">
  <h1>View Detail</h1>
  <form name='registration' id='register' action='updateCustomer.php' method='post'
      accept-charset='UTF-8'>

  <?php
  $code=$_GET['code'];
  $result = sqlsrv_query($conn,"SELECT * FROM customerMaster WHERE CustomerCode='$code'");
  $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)
  ?>
  <div class="section">Customer Code*:</div >
  <input type='text' name='code' id='code' maxlength="50" value="<?php echo $row['CustomerCode']?>" />

  <div class="section">Customer Name*:</div >
  <input type='text' name='name' id='name' maxlength="50" value="<?php echo $row['CustomerName']?>" />

  <div class="section">Address*:</div >
  <textarea rows="4" cols="50" name='address'><?php echo $row['Address'] ; ?></textarea>

  <div class="section">Contact Name*:</div >
  <input type='text' name='contactName' id='contactName' maxlength="50" value="<?php echo $row['ContactName']?>" />

  <div class="section">Contact No*:</div >
  <input type='text' name='contactNo' id='contactNo' maxlength="50" value="<?php echo $row['ContactNo']?>" />

  <br/>
  <br/>
  <input class="btn btn-submit" type='submit' name='Update' value='Save Changes' onclick="return formValidation();"/>
  <input class="btn btn-submit" type='submit' name='Cancel' value='Cancel' /> 

  </form>
  </div>

<?php

// get results from database


$result = sqlsrv_query($conn,"SELECT * FROM customerMaster");

// display data in table

echo '<center>';
echo '<p align="center"><h1>Modules</h1></p>';
echo "<table border='1' cellpadding='10' >";

echo "<tr><th>Customer Code</th> <th>Customer Name</th> <th>Address</th> <th>Contact Name</th> <th>Contact No</th> </tr>";



// loop through results of database query, displaying them in the table

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {

// echo out the contents of each row into a table

echo "<tr>";

echo '<td>' . $row['CustomerCode'] . '</td>';

echo '<td>' . $row['CustomerName'] . '</td>';

echo '<td>' . $row['Address'] . '</td>';

echo '<td>' . $row['ContactName'] . '</td>';

echo '<td>' . $row['ContactNo'] . '</td>';


echo "</tr>";

}

echo "</table>";
echo '</center>';
 
if(isset($_POST['Update'])){

	$code=$_POST['code'];
	$name=$_POST['name'];
	$address=$_POST['address'];
	$contactName=$_POST['contactName'];
	$contactNo=$_POST['contactNo'];
	$query = "UPDATE customerMaster SET CustomerName ='$name',Address='$address',ContactName='$contactName',ContactNo='$contactNo' WHERE CustomerCode ='$code'";
	$result = sqlsrv_query($conn,$query);
	header('Location: viewCustomer.php#bottom');
	exit;
}

if(isset($_POST['Cancel'])){

	header('Location: viewCustomer.php'); 
	exit;
}

?>


</body>

</html>

<?php
ob_end_flush();
?>