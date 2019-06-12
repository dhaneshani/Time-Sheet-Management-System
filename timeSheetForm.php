<?php
ob_start();
include('session.php');
include('timeSheetMenu.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Time Sheet</title>
<link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="table.css" rel="stylesheet" type="text/css">
  <link href="timeSheetForm.css" rel="stylesheet" type="text/css">
  <script src="js/bootstrap.min.js"></script>
  <script src="saveData.js"></script>
  <script src="sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="sweetalert/dist/sweetalert.css">
  <link rel="stylesheet" href="medium-style/css/msc-style.css">
</head>

<body background="image1.jpg">
<div class="form-style-10">
<h1>Time Sheet<span>Fill the details</span></h1>
<form class="form-inline" name="form" method='post' action='timeSheetForm.php' onSubmit="return saveData();">
	<div style="font-size:12px">

   	<div class="form-group">
  	<div class="section">Date</div>
  	<input id="date" type="date" name="date" />
    </div>

   	<div class="form-group">
    <div class="section">Customer</div>
    	
    	<?php
    	$query = "SELECT * FROM customerMaster";
  		$result = sqlsrv_query($conn,$query);
  		?>
  		<select id="customer" name="customer">
  		<option value="" hidden>Choose an option:</option>
  		<?php while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)):;?>
  		<option value="<?php echo $row['CustomerName'] ;?>"><?php echo $row['CustomerName'] ;?></option>
  		<?php endwhile; ?>
  		</select>
    	
    </div>

  	<div class="form-group">
    <div class="section">Module</div>
        
        <?php
    	$query = "SELECT * FROM module";
  		$result = sqlsrv_query($conn,$query);
  		?>
  		<select id="module" name="module">
  		<option value="" hidden >Choose an option:</option>
  		<?php while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)):;?>
  		<option value="<?php echo $row['name'] ;?>"><?php echo $row['name'] ;?></option>
  		<?php endwhile; ?>
  		</select>
    	
    </div>
   
    
    <div class="form-group">
    <div class="section">Work Type</div>
        
        <?php
    	$query = "SELECT * FROM workType";
  		$result = sqlsrv_query($conn,$query);
  		?>
  		<select id="workType" name="workType">
  		<option value="" hidden>Choose an option:</option>
  		<?php while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)):;?>
  		<option value="<?php echo $row['TypeName'] ;?>"><?php echo $row['TypeName'] ;?></option>
  		<?php endwhile; ?>
  		</select>
    	
   </div>

    <div class="form-group">
    <div class="section">Start Time</div>
        <input id="startTime" type="time" name="startTime" />
    	
   	</div>

	<div class="form-group">
    <div class="section">End Time</div>
        
        <input id="endTime" type="time" name="endTime" />
    	
    </div>
    </div>
    <br>
    <div class="form-group">
	<div class="section">Description</div>
    <textarea id="description" rows="6" cols="132" name="description"></textarea>
   	</div>


    <div class="button-section">
    <br>
    <input type="submit" name="Save" value="Submit"/>
    <input type="submit" name="Cancel" value="Cancel"/>
    <input type="submit" name="View" value="View"/>
    </div>
</form>
</div>
<br>

<?php 
//echo $_SESSION['login_user'];
if(isset($_POST['Save'])){
	
	$user=$_SESSION['login_user'];
	$date=$_POST['date'];
	$customer=$_POST['customer'];
	$module=$_POST['module'];
	$workType=$_POST['workType'];
	$description=$_POST['description'];
	$startTime=$_POST['startTime'];
	$endTime=$_POST['endTime'];
	$date1=strtotime($_POST['startTime']);
	$date2=strtotime($_POST['endTime']);
	$diff=($date2-$date1)/60;

  $query = "SELECT * FROM empMaster WHERE UserName='$user'";
  $result = sqlsrv_query($conn,$query);
  $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
  $employee= $row['EmpName'];
  
	function convertToHoursMins($time, $format = '%02d:%02d'){
	    if ($time < 1) {
	        return;
	    }
	    $hours = floor($time / 60);
	    $minutes = ($time % 60);
	    return sprintf($format, $hours, $minutes);
	}

	$duration=convertToHoursMins($diff, '%02d hours %02d minutes');
	
	if(isset($date) && trim($date) != '')
	{
	//$_SESSION['week']=$week;
	$duedt = explode("-",$date);
	$date_temp = mktime(0, 0, 0, $duedt[1], $duedt[2],$duedt[0]);
	$week_temp = (int)date('W', $date_temp);
	$week1=(string)"W".$week_temp;
	$week=(string)"2016-".$week1;
	$_SESSION['week']=$week;
	}
	
	if(!isset($date) || trim($date) == ''||!isset($description) || trim($description) == ''||!isset($startTime) || trim($startTime) == ''||!isset($endTime) || trim($endTime) == ''||!isset($customer) || trim($customer) == ''||!isset($module) || trim($module) == ''||!isset($workType) || trim($workType) == '')
	{

	  echo "<script type=\"text/javascript\">";
    echo "sweetAlert('Sorry!','You did not fill out the required fields.','warning');";
    echo "showData();";
    echo "</script>";

	}elseif($diff < 0 || $diff > 1440){
		echo "
            <script type=\"text/javascript\">
            sweetAlert('Sorry!','Invalid time Duration!! Check start time and end time.','warning');
            showData();
            </script>
        ";
    }	
	else{
		$query = "INSERT INTO timeSheet(UserName,Week,Day,Employee,Customer,Module,WorkType,Description,StartTime,EndTime,Duration,Confirmation) VALUES ('$user','$week','$date','$employee','$customer','$module','$workType','$description','$startTime','$endTime','$duration','No')";
		sqlsrv_query($conn,$query);
		header("Location: viewTimeDetail.php"); 
    exit;
    }

	$date="";
	$customer="";
	$module="";
	$workType="";
	$description="";
	$startTime="";
	$endTime="";

}

if(isset($_POST['Cancel'])){
	$date="";
	$customer="";
	$module="";
	$workType="";
	$description="";
	$startTime="";
	$endTime="";
  	
}
if(isset($_POST['View'])){
	header("Location: ViewTimeSheetHistory.php#bottom"); 
    exit;
}

?>



</body>
</html>
<?php
ob_end_flush();
?>