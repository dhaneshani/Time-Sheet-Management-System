<?php
include('session.php');
include('timeSheetMenu.php');
?>

<!DOCTYPE html>
<html >
  <head>
  <link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="timeSheetForm.css" rel="stylesheet" type="text/css">
  <script src="js/bootstrap.min.js"></script>
  <script src="sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="sweetalert/dist/sweetalert.css">
  </head>	
  <body background="image1.jpg">
  	<div class="form-style-11">
	<h3>Change your password</h3>
	<form action='changepassword.php' method='POST'>
		<div class="section">Old password:</div><input type='text' name='oldpassword'><p>
		<div class="section">New password:</div><input type='password' name='newpassword'><p>
		<div class="section">Repeat new password:</div><input type='password' name='repeatnewpassword'><p>
		<br>
		<input type='submit' name='Submit' value='Change Password'>
		<input type='submit' name='Cancel' value='Cancel'>
	</body>
	</form>
	</div>


<?php
$user = $_SESSION['login_user'];


		if (isset($_POST['Submit']))
		{
		//check fields
		
		$oldpassword = sha1($_POST['oldpassword']);
		$newpassword = sha1($_POST['newpassword']);
		$repeatnewpassword = sha1($_POST['repeatnewpassword']);
		
		$queryget = sqlsrv_query($conn,"SELECT Password FROM empMaster WHERE username='$user'");
		$row = sqlsrv_fetch_array($queryget, SQLSRV_FETCH_ASSOC);
		$oldpassworddb = $row['Password'];
		
			
		
		//check pass
		if ($oldpassword==$oldpassworddb)
		{
		
		
		
		//check twonew pass
		if ($newpassword==$repeatnewpassword)
		{

		
				$querychange = sqlsrv_query($conn,"UPDATE empMaster SET Password='$newpassword' WHERE Username='$user'");
				echo "<script type=\"text/javascript\">;
				sweetAlert('Sorry!','Your password has been changed.Use new password when you login','warning');
				</script>";
				header("Location:logout.php");
				
		
		
		
		
		
		}
		else

			echo "<script type=\"text/javascript\">;
				sweetAlert('Sorry!','New Password does not match','warning');
				</script>";
	
		}
		else
			echo "<script type=\"text/javascript\">;
				sweetAlert('Sorry!','Old Password does not match','warning');
				</script>";
			
		
		
			
		
		
		
		}

		if (isset($_POST['Cancel']))
		{
			
		}
		
?>
		

		

