<?php
include ('timeSheetForm.php');
$week=$_SESSION['week'];
$user=$_SESSION['login_user'];
$result = sqlsrv_query($conn,"SELECT * FROM timeSheet WHERE Week='$week'");
		
		echo '<center>';
		//echo '<p align="center"><h1>Time Sheet</h1></p>';
		echo "<table border='1' cellpadding='10'>";

		echo "<tr><th>Week</th><th>Date</th> <th>Customer</th><th>Module</th><th>Work Type</th><th>Description</th><th>Start Time</th><th>End Time</th><th>Duration</th><th></th><th></th></tr>";



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

		echo '<td>' . $row['Duration'] . '</td>';

		echo '<td><a href="updateTimeSheet.php?id=' . $row['ID'] .'">Edit</a></td>';

		echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this record?');\" href='deleteTimeSheet.php?id=".$row['ID']."'>Delete</a></td><tr>";


		echo "</tr>";

		}



		// close table>

		echo "</table>";
		echo '</center>';
 
?>