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
        if (isset($_GET['code']))
        {
			// get the 'id' variable from the URL
			$code = $_GET['code'];

			// delete record from database
			$sql = "DELETE FROM module WHERE code='$code' ";
			$query = sqlsrv_query($conn, $sql);
			header("Location: view.php");
	
// redirect user after delete is successful

		}
		else
// if the 'id' variable isn't set, redirect the user
		{
			header("Location: view.php");
		}
	?>
    }
    else{
        	<?php header("Location: view.php");?>
    }
    ?>
    document.getElementById("demo").innerHTML = txt;
}
</script>

</body>
</html>
