<?php
include('session.php');
?>
<!DOCTYPE html>
<html>
<body>


<script>
function myFunction() {
    var txt;
    var r = confirm("Press a button!");
    if (r == true) {
    <?php
        if (isset($_GET['id']))
        {
			// get the 'id' variable from the URL
			$id = $_GET['id'];

			// delete record from database
			$sql = "UPDATE timeSheet SET Confirmation='Yes' WHERE ID='$id' ";
			$query = sqlsrv_query($conn, $sql);
			if($_SESSION['History']=="user"){
			header("Location: viewTimeSheetHistory.php");	
			}else{
			header("Location: viewTimeDetail.php");
			}
// redirect user after delete is successful

		}
		else
// if the 'id' variable isn't set, redirect the user
		{
			if($_SESSION['History']=="user"){
			header("Location: viewTimeSheetHistory.php");	
			}else{
			header("Location: viewTimeDetail.php");
			}
		}
	?>
    }
    else{
        	<?
        	if($_SESSION['History']=="user"){
			header("Location: viewTimeSheetHistory.php");	
			}else{
			header("Location: viewTimeDetail.php");
			}
        	?>
    }
  
    document.getElementById("demo").innerHTML = txt;
}
</script>

</body>
</html>