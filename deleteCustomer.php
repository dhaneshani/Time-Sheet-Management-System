<?php
include('session.php');
?>

<?php

// connect to the database
$serverName = "localhost"; 
//sa
//tstc123
$connectionInfo = array("Database"=>"SoftwareDepartmentSystem","UID"=>"sa", "PWD"=>"tstc123");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     //echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
//include('connect-db.php');

// confirm that the 'id' variable has been set
?>
<!DOCTYPE html>
<html>
<body>


<script>
function myFunction() {
    //var txt;
    //var r = confirm("Press a button!");
    //if (r == true) {
    <?php
        if (isset($_GET['code']))
        {
			// get the 'id' variable from the URL
			$code = $_GET['code'];

			// delete record from database
			$sql = "DELETE FROM customerMaster WHERE CustomerCode='$code' ";
			$query = sqlsrv_query($conn, $sql);
			header("Location: viewCustomer.php");
	
// redirect user after delete is successful

		}
		else
// if the 'id' variable isn't set, redirect the user
		{
			header("Location: viewCustomer.php");
		}
	?>
    //}
    //else{
        	//<?php header("Location: viewCustomer.php");?>
    //}
    ?>
    document.getElementById("demo").innerHTML = txt;
}
</script>

</body>
</html>
