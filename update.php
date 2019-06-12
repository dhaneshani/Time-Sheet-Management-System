<?php
ob_start();
include('session.php');
include('adminMenu.php');
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Update Modules</title>
   
</head>

<body background="image1.jpg">
  <div class="form-style-10">
  <h1>Module Master</h1>
  <form name='registration' id='register' action='update.php' method='post'
      accept-charset='UTF-8'>

          <?php
          $code=$_GET['code'];
          $result = sqlsrv_query($conn,"SELECT * FROM module WHERE code='$code'");
          $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
          ?>
          
              <div class="section">Module Code*:</div>
              <input type='text' name='code' id='code' maxlength="50" value="<?php echo $row['code'] ?>" />
            
              <div class="section">Module Name*:</div>
              <input type='text' name='name' id='name' maxlength="50" value="<?php echo $row['name'] ?>" /> 
  																			
            
              <input class="btn btn-submit" type="submit" name='Update' value="Save Changes" onclick="return formValidation();" />
              <input class="btn btn-submit" type='submit' name='Cancel' value='Cancel' /> 
          
           
  </form>
  </div>

<div id='bottom'>
<?php

// get results from database

$result = sqlsrv_query($conn,"SELECT * FROM module");

// display data in table

echo '<center>';
echo '<p align="center"><h1>Modules</h1></p>';
echo "<table border='1' cellpadding='10'>";

echo "<tr><th>Module Code</th> <th>Module Name</th></tr>";



// loop through results of database query, displaying them in the table

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {



// echo out the contents of each row into a table

echo "<tr>";

echo '<td>' . $row['code'] . '</td>';

echo '<td>' . $row['name'] . '</td>';

//echo '<td><a href="update.php?name=' . $row['name'] . '&code=' . $row['code'] . '">Edit</a></td>';

//echo '<td><a href="delete.php?code=' . $row['code'] . '">Delete</a></td>';

echo "</tr>";

}



// close table>

echo "</table>";
echo '</center>';
if(isset($_POST['Update'])){

	$code=$_POST['code'];
	$name=$_POST['name'];
	$query = "UPDATE module SET name ='$name' WHERE code ='$code'";
	$result = sqlsrv_query($conn,$query);
	header('Location: view.php#bottom');  
	exit;
}

if(isset($_POST['Cancel'])){

	header('Location: view.php'); 
	exit;
}

?>
</div>

</body>

</html>

<?php
ob_end_flush();
?>