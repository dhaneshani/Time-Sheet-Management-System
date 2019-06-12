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
  <link href="table.css" rel="stylesheet" type="text/css">
  <script src="js/bootstrap.min.js"></script>
  <script src="sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="sweetalert/dist/sweetalert.css">
  <script type="text/javascript">
  function jsFunction()
	{
	if(document.getElementById('dateRange').selected==true){
    document.getElementById('daterange').hidden = "";
	}else{
	document.getElementById('daterange').hidden = "hidden";	
	}
	}
</script>
  </head>	
  <body background="image1.jpg">

  	<div style="width:500px;"  class="form-style-10">
	<h1>View Detail</h1>
	<form action='filterTimeSheetDetail.php' method='POST'>
		<span class="inlineinput" >
		<input type="radio" name="confirmation" value="Yes"><div style="padding:0px 75px 0px 20px;"><div class="section">Confirmed</div></div>
  		<input type="radio" name="confirmation" value="No"><div style="padding:0px 75px 0px 20px;"><div class="section">Pending</div></div>
  		</span>
  		<br>
  		<br>
		<div class="section">Week:</div>
		<div style="width:420px; overflow:hidden">
		<?php
    	$query = "SELECT DISTINCT(Week) FROM timeSheet";
  		$result = sqlsrv_query($conn,$query);
  		?>
  		<select id="week" name="week" onchange="jsFunction();">
  		<option value="" hidden>Select a week</option>
  		<option value="<?php echo date("Y"); ?>">All Weeks</option>
  		<option id="dateRange" value="dateRange">Date Range</option>
  		<?php while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)):;?>
  		<option value="<?php echo $row['Week'] ;?>"><?php echo $row['Week'] ;?></option>
  		<?php endwhile; ?>
  		</select>
  		<div>

  		<div id="daterange"  hidden="hidden">
  		<br>
      	<div class="section">Date Range:</div >
      	<span class="inlineinput" ><input type="date" id="date1" name="date1" style='display: inline; width: 200px;'><div class="section">To</div><input type="date" id="date2" name="date2" style='display: inline; width: 200px;'>
      	</span>
    	</div>
		<br>
		<input type='submit' name='Submit' value='View'>
		<input type='submit' name='Cancel' value='Cancel'>
		</div>
	
	</form>
	</div>
	</div>


<?php
if(isset($_POST['Submit'])){
	

	$user=$_SESSION['login_user'];
	if(isset($_POST['confirmation'])){$confirmation=$_POST['confirmation'];}
	$week=$_POST['week'];
	$date1=$_POST['date1'];
	$date2=$_POST['date2'];
	
	

	if(!isset($confirmation) || trim($confirmation) == ''||!isset($week) || trim($week) == '')
	{

		echo "<script type=\"text/javascript\">";
	    echo "sweetAlert('Sorry!','You did not fill out the required fields.','warning');";
	    //echo "showData();";
	    echo "</script>";

	}elseif($week=="dateRange"&&(!isset($date1) || trim($date1) == ''||!isset($date2) || trim($date2) == '')){
		

		echo "<script type=\"text/javascript\">";
	    echo "sweetAlert('Sorry!','Please enter a date range.','warning');";
	    //echo "showData();";
	    echo "</script>";

		

    }	
	else{
		$_SESSION['confirmation']=$confirmation;
		$_SESSION['week']=$week;
		$_SESSION['date1']=$date1;
		$_SESSION['date2']=$date2;
		
		if($week!="dateRange"){
			$query = "SELECT * FROM timeSheet WHERE UserName='$user' AND confirmation='$confirmation' AND Week LIKE  '%{$week}%' ";
			$result=sqlsrv_query($conn,$query);

		}else{
			$query = "SELECT * FROM timeSheet WHERE UserName='$user' AND confirmation='$confirmation' AND Day BETWEEN  '$date1' AND '$date2' ";
			$result=sqlsrv_query($conn,$query);
		}
		
		
		echo '<br>';
		echo '<center>';

		echo "<table border='1' cellpadding='10'>";

		echo "<tr><th>Week</th><th>Date</th> <th>Customer</th><th>Module</th><th>Work Type</th><th>Description</th><th>Start Time</th><th>End Time</th><th>Duration</th></tr>";
		while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {


		echo "<tr>";

		echo '<td>' . $row['Week'] . '</td>';

		echo '<td>' . $row['Day'] . '</td>';

		echo '<td>' . $row['Customer'] . '</td>';

		echo '<td>' . $row['Module'] . '</td>';

		echo '<td>' . $row['WorkType'] . '</td>';

		echo '<td>' . $row['Description'] . '</td>';

		echo '<td>' . $row['StartTime'] . '</td>';

		echo '<td>' . $row['EndTime'] . '</td>';

		echo '<td>' . $row['Duration'] . '</td>';

		echo "</tr>";

		}
		
		echo "</table>";
		echo '<a href="pdf.php"  target="_blank">Download as pdf</a>';

		echo '</center>';
		
		
    }
    
}

if(isset($_POST['Cancel'])){
	
  	
}


?>
</body>

</html>