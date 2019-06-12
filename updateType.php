<?php
ob_start();
include('session.php');
include('adminMenu.php');
?>
<html>

<head>
  <title>Update Work Types</title>
  <meta charset="UTF-8">
</head>

<body background="image1.jpg">
    <div class="form-style-10">
    <h1>View Detail</h1>
    <form name='registration' id='register' action='updateType.php' method='post'
        accept-charset='UTF-8'>
    
    <?php
    $code=$_GET['code'];
    $result = sqlsrv_query($conn,"SELECT * FROM workType WHERE TypeCode='$code'");
    $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)
    ?>
    <div class="section">Type Code*:</div>
    <input type='text' name='code' id='code' maxlength="50" value="<?php echo $row['TypeCode']?>" />

    <div class="section">Type Name*:</div>
    <input type='text' name='name' id='name' maxlength="50" value="<?php echo $row['TypeName'] ?>" />

    <br/>
    <input class="btn btn-submit" type='submit' name='Update' value='Save Changes' onclick="return formValidation();" /> 
    <input class="btn btn-submit" type='submit' name='Cancel' value='Cancel' /> 
    </form>
    </div>

<?php

// get results from database

$result = sqlsrv_query($conn,"SELECT * FROM workType");

// display data in table
echo '<center>';
echo '<p align="center"><h1>Work Types</h1></p>';
echo "<table border='1' cellpadding='10'>";

echo "<tr><th>Type Code</th> <th>Type Name</th></tr>";



// loop through results of database query, displaying them in the table

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {



// echo out the contents of each row into a table

echo "<tr>";

echo '<td>' . $row['TypeCode'] . '</td>';

echo '<td>' . $row['TypeName'] . '</td>';

//echo '<td><a href="update.php?name=' . $row['name'] . '&code=' . $row['code'] . '">Edit</a></td>';

//echo '<td><a href="delete.php?code=' . $row['code'] . '">Delete</a></td>';

echo "</tr>";
echo '</center>';
}



// close table>

echo "</table>";
 
if(isset($_POST['Update'])){

	$code=$_POST['code'];
	$name=$_POST['name'];
	$query = "UPDATE workType SET TypeName ='$name' WHERE TypeCode ='$code'";;
	$result = sqlsrv_query($conn,$query);
	header('Location: viewType.php#bottom'); 
	exit;
}

if(isset($_POST['Cancel'])){

	header('Location: viewType.php'); 
	exit;
}

?>


</body>
</html>

<?php
ob_end_flush();
?>