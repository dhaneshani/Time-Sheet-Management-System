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
<script src="js/bootstrap.min.js"></script>
<link href="timeSheetForm.css" rel="stylesheet" type="text/css">
<script src="saveData.js"></script>
<style type="text/css">
</style>
</head>

<body background="image1.jpg">
<div class="form-style-10">
<h1>Time Sheet<span>Edit the details</span></h1>
<form class="form-inline" name="form" method='post' action='updateTimeSheet.php' onSubmit="return saveData();">
	<div style="font-size:12px">
	<?php
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$_SESSION['id']=$id;
		}else{
			$id=$_SESSION['id'];
		}
    
        $result = sqlsrv_query($conn,"SELECT * FROM timeSheet WHERE ID=$id");
        $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

    ?>

 
   	<div class="form-group">
   	<div class="section">Date</div>
    <input id="date" type="date" name="date" value="<?php echo $row['Day'] ?>"/>
   	</div>
   
   	
    <div class="form-group">
    <div class="section">Customer</div>
    	<?php
    	$query = "SELECT * FROM customerMaster";
  		$result1 = sqlsrv_query($conn,$query);
  		?>
  		<select id="customer" name="customer">
  		<?php while($row2 = sqlsrv_fetch_array( $result1, SQLSRV_FETCH_ASSOC)):;?>
  		<option value="<?php echo $row2['CustomerName'] ;?>" <?php if(strcmp($row['Customer'],$row2['CustomerName'])==0){$select="selected";}else{$select="";} ?> <?php echo $select?>> <?php echo $row2['CustomerName'] ;?></option> 
  		<?php endwhile; ?>
  		</select>
    	</div>
    	
  
    <div class="form-group">
    <div class="section">Module</div>
        <?php
    	$query = "SELECT * FROM module";
  		$result2 = sqlsrv_query($conn,$query);
  		?>
  		<select id="module" name="module">
  		<?php while($row2 = sqlsrv_fetch_array( $result2, SQLSRV_FETCH_ASSOC)):;?>
  		<option value="<?php echo $row2['name'] ;?>" <?php if(strcmp($row['Module'],$row2['name'])==0){$select="selected";}else{$select="";} ?> <?php echo $select?>><?php echo $row2['name'] ;?></option>
  		<?php endwhile; ?>
  		</select>
    	</div>
    	

    <div class="form-group">
    <div class="section">Work Type</div>
        <?php
    	$query = "SELECT * FROM workType";
  		$result2 = sqlsrv_query($conn,$query);
  		?>
  		<select id="workType" name="workType">
  		<?php while($row2 = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC)):;?>
  		<option value="<?php echo $row2['TypeName'] ;?>" <?php if(strcmp($row['WorkType'],$row2['TypeName'])==0){$select="selected";}else{$select="";} ?> <?php echo $select?>> <?php echo $row2['TypeName'] ;?></option>
  		<?php endwhile; ?>
  		</select>
    	</div>
    	

    <div class="form-group">
    <div class="section">Start Time</div>
        <input id="startTime" type="time" name="startTime" value="<?php echo $row['StartTime'] ?>"/>
    </div>
    	

    <div class="form-group">
    <div class="section">End Time</div>
        <input id="endTime" type="time" name="endTime" value="<?php echo $row['EndTime'] ?>"/>
    </div>


    <div class="section">Description</div>
    <textarea id="description" rows="6" cols="132" name="description" ><?php echo $row['Description']; ?></textarea>
    <br>
	 </div>

    <div class="button-section">
    <input type="submit" name="Save" value="Save Changes"/>
    <input type="submit" name="Cancel" value="Cancel"/>
    </div>
</form>
</div>
<br>

<?php 
if($_SESSION['History']=="user"){
    $user=$_SESSION['login_user'];
    $result = sqlsrv_query($conn,"SELECT * FROM timeSheet WHERE UserName='$user'");
    
    echo '<center>';
    //echo '<p align="center"><h1>Time Sheet</h1></p>';
    echo "<table border='1' cellpadding='10'>";

    echo "<tr><th>Week</th><th>Date</th> <th>Customer</th><th>Module</th><th>Work Type</th><th>Description</th><th>Start Time</th><th>End Time</th><th></th><th></th><th></th></tr>";



    // loop through results of database query, displaying them in the table

    while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {



    // echo out the contents of each row into a table

    echo "<tr>";

    echo '<td>' . $row['Week'] . '</td>';

    echo '<td>' . $row['Day'] . '</td>';

    echo '<td>' . $row['Customer'] . '</td>';

    echo '<td>' . $row['Module'] . '</td>';

    echo '<td>' . $row['WorkType'] . '</td>';

    echo '<td>' . $row['Description'] . '</td>';

    echo '<td>' . $row['StartTime'] . '</td>';

    echo '<td>' . $row['EndTime'] . '</td>';

    echo '<td><a href="updateTimeSheet.php?id=' . $row['ID'] .'">Edit</a></td>';

    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this record?');\" href='deleteTimeSheet.php?id=".$row['ID']."'>Delete</a></td>";

    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to confirm this record?');\" href='confirmTimeSheet.php?id=".$row['ID']."'>Confirm</a></td>";


    echo "</tr>";

    }



    // close table>

    echo "</table>";
    echo '</center>'; 
}else{
    $week=$_SESSION['week'];

    $result = sqlsrv_query($conn,"SELECT * FROM timeSheet WHERE Week='$week'");
  
    echo '<center>';

    echo "<table border='1' cellpadding='10'>";

    echo "<tr><th>Week</th><th>Date</th> <th>Customer</th><th>Module</th><th>Work Type</th><th>Description</th><th>Start Time</th><th>End Time</th><th></th><th></th><th></th></tr>";



    // loop through results of database query, displaying them in the table

    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {



    // echo out the contents of each row into a table

    echo "<tr>";

    echo '<td>' . $row['Week'] . '</td>';

    echo '<td>' . $row['Day'] . '</td>';

    echo '<td>' . $row['Customer'] . '</td>';

    echo '<td>' . $row['Module'] . '</td>';

    echo '<td>' . $row['WorkType'] . '</td>';

    echo '<td>' . $row['Description'] . '</td>';

    echo '<td>' . $row['StartTime'] . '</td>';

    echo '<td>' . $row['EndTime'] . '</td>';

    echo '<td><a href="updateTimeSheet.php?id=' . $row['ID'] .'">Edit</a></td>';

    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this record?');\" href='deleteTimeSheet.php?id=".$row['ID']."'>Delete</a></td>";

    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to confirm this record?');\" href='confirmTimeSheet.php?id=".$row['ID']."'>Confirm</a></td>";


    echo "</tr>";

    }



    // close table>

    echo "</table>";
    echo '</center>';


}

if(isset($_POST['Save'])){
	//$week=$_POST['week'];
	$id=$_SESSION['id'];
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

	function convertToHoursMins($time, $format = '%02d:%02d') {
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
	
	if(!isset($date) || trim($date) == ''||!isset($description) || trim($description) == ''||!isset($startTime) || trim($startTime) == ''||!isset($endTime) || trim($endTime) == '')
	{
    echo "<script type=\"text/javascript\">";
    echo "alert('You did not fill out the required fields.');";
    echo "showData();";
    echo "</script>";
	}elseif($diff < 0 || $diff > 1440){
		echo "
            <script type=\"text/javascript\">
            alert('Invalid time Duration!! Check start time and end time.');
            </script>
        ";
    }
	else{

		$query = "UPDATE timeSheet SET Day='$date',Week='$week',Customer='$customer',Module='$module',WorkType='$workType',Description='$description',StartTime='$startTime',EndTime='$endTime',Duration='$duration' WHERE ID='$id'";
		sqlsrv_query($conn,$query);
			if($_SESSION['History']=="user"){
			header("Location: viewTimeSheetHistory.php");	
			}else{
			header("Location: viewTimeDetail.php");
			}
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
        	if($_SESSION['History']=="user"){
			header("Location: viewTimeSheetHistory.php");	
			}else{
			header("Location: viewTimeDetail.php");
			}
        	
}

?>



</body>
</html>
<?php
ob_end_flush();
?>