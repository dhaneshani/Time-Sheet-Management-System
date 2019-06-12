<?php

include('session.php');

?>

<?php
	require("mpdf/mpdf.php");
	$mpdf = new mPDF();
	$user=$_SESSION['login_user'];
	$confirmation=$_SESSION['confirmation'];
	$week=$_SESSION['week'];
	$date1=$_SESSION['date1'];
	$date2=$_SESSION['date2'];
	if($week!="dateRange"){
			$query = "SELECT * FROM timeSheet WHERE UserName='$user' AND confirmation='$confirmation' AND Week LIKE  '%{$week}%' ";
			$result=sqlsrv_query($conn,$query);

		}else{
			$query = "SELECT * FROM timeSheet WHERE UserName='$user' AND confirmation='$confirmation' AND Day BETWEEN  '$date1' AND '$date2' ";
			$result=sqlsrv_query($conn,$query);
		}
		
		
		$mpdf->WriteHTML("<br>");
		$mpdf->WriteHTML("<center>");
		$mpdf->WriteHTML("<table border='1' cellpadding='10'>");
		$mpdf->WriteHTML("<tr><th>Week</th><th>Date</th> <th>Customer</th><th>Module</th><th>Work Type</th><th>Description</th><th>Start Time					</th><th>End Time</th><th>Duration</th></tr>");
		while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$week=$row['Week'];
		$date=$row['Day'];
		$customer=$row['Customer'];
		$module=$row['Module'];
		$workType=$row['WorkType'];
		$description=$row['Description'];
		$startTime=$row['StartTime'];
		$endTime=$row['EndTime'];
		$duration=$row['Duration'];

		$mpdf->WriteHTML("<tr>");
		$mpdf->WriteHTML("<td> $week </td>");
		$mpdf->WriteHTML("<td> $date </td>");
		$mpdf->WriteHTML("<td> $customer </td>");
		$mpdf->WriteHTML("<td> $module </td>");
		$mpdf->WriteHTML("<td> $workType </td>");
		$mpdf->WriteHTML("<td> $description </td>");
		$mpdf->WriteHTML("<td> $startTime </td>");
		$mpdf->WriteHTML("<td> $endTime </td>");
		$mpdf->WriteHTML("<td> $duration </td>");
		$mpdf->WriteHTML("</tr>");
		}

		$mpdf->WriteHTML("</table>");
		$mpdf->WriteHTML("</center>");
		$mpdf->Output();
		exit;
?>	

