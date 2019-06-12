<?php
include('session.php');
include('adminMenu.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Customer Master</title>
</head>
<body background="image1.jpg">

<div class="form-style-10">
<h1>View Detail</h1>
<form name='registration' onSubmit="return formValidation();" id='register' action='customerMaster.php' method='post'
    accept-charset='UTF-8' class="STYLE-NAME">

<div class="section">Customer Code*:</div >
<input type='text' name='code' id='code' maxlength="50" />

<div class="section">Customer Name*:</div >
<input type='text' name='name' id='name' maxlength="50" />

<div class="section">Address*:</div >
<textarea rows="4" cols="50" name='address'></textarea>

<div class="section">Contact Name*:</div >
<input type='text' name='contactName' id='contactName' maxlength="50" />

<div class="section">Contact No*:</div >
<input type='text' name='contactNo' id='contactNo' maxlength="50" />

<br>
<input class="btn btn-submit" type='submit' name='Submit' value='Submit' />
<a href="viewCustomer.php#bottom">View Customers</a>

</form>
</div>

</body>
</html>

<?php

if(isset($_POST['Submit'])){
	$code=$_POST['code'];
	$name=$_POST['name'];
	$address=$_POST['address'];
	$contactName=$_POST['contactName'];
	$contactNo=$_POST['contactNo'];
  $query1= "SELECT * FROM customerMaster WHERE CustomerCode='$code'";
  $result1 = sqlsrv_query($conn,$query1);
  $row = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC);
  if (count($row)== 0){
  $query2 = "INSERT INTO customerMaster (CustomerCode,CustomerName,Address,ContactName,ContactNo) VALUES ('$code','$name','$address','$contactName','$contactNo')";
  $result2 = sqlsrv_query($conn,$query2);
  header('Location: viewCustomer.php#bottom'); 
  exit;
  }else{
        echo "
            <script type=\"text/javascript\">
            alert('This Customer is already Exit.');
            </script>
        ";
  }
	
}  

if(isset($_POST['logout'])){

  header('Location: logout.php'); 
  exit;
}
  
?>

