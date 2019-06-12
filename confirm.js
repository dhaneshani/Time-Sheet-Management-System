
function myFunction() {
    var r = confirm("Are you sure you want to confirm");
   	localStorage.setItem('id', id);
    
    <?php
    		$serverName = "localhost"; 
			$connectionInfo = array("Database"=>"SoftwareDepartmentSystem","UID"=>"sa", "PWD"=>"tstc123");
			$conn = sqlsrv_connect( $serverName, $connectionInfo);

			if( $conn ) {
     //echo "Connection established.<br />";
			}else{
			     echo "Connection could not be established.<br />";
			     die( print_r( sqlsrv_errors(), true));
			}
       		$ID == "<script>document.write(localStorage.getItem('id'));</script>";
			$sql = "UPDATE timeSheet SET Confirmation='Yes' WHERE ID='$ID' ";
			$query = sqlsrv_query($conn, $sql);
			

    ?>
    //alert("Confirm");
}
