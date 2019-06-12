<?php
ob_start();
include('session.php');
include('adminMenu.php');
?>

<html>

<head>

</head>

<body background="image1.jpg">

  <div class="form-style-10">
  <h1>View Detail</h1>
  <form name='registration' id='register' action='updateEmp.php' method='post'
      accept-charset='UTF-8' class="STYLE-NAME">

  <?php
  $code=$_GET['code'];
  $result = sqlsrv_query($conn,"SELECT * FROM empMaster WHERE EmpCode='$code'");
  $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)
  ?>

  <div class="section">Employee Code*: </div>
  <input type='text' name='code' id='code' maxlength="50" value="<?php echo $row['EmpCode'] ?>" />

  <div class="section">Employee Name*: </div>
  <input type='text' name='name' id='name' maxlength="50" value="<?php echo $row['EmpName'] ?>" />

  <div class="section">Designation*: </div>
  <input type='text' name='designation' id='designation' maxlength="50" value="<?php echo $row['Designation'] ?>" />

  <div class="section">Employee Type*: </div>
  <select name='type' >

    <option value="Permenent" <?php if(strcmp($row['EmpType'],"Permenent")==0){$select1="selected";}else{$select1="";} ?> <?php echo $select1 ?> >Permenent </option>
    <option value="Probation" <?php if(strcmp($row['EmpType'],"Probation")==0){$select2="selected";}else{$select2="";} ?> <?php echo $select2 ?> >Probation</option>
    <option value="Contract" <?php if(strcmp($row['EmpType'],"Contract")==0){$select3="selected";}else{$select3="";} ?> <?php echo $select3 ?>  >Contract</option>
    <option value="Internship" <?php if(strcmp($row['EmpType'],"Internship")==0){$select4="selected";}else{$select4="";} ?> <?php echo $select4 ?>>Internship</option>
    <option value="Training" <?php if(strcmp($row['EmpType'],"Training")==0){$select5="selected";}else{$select5="";} ?> <?php echo $select5 ?>>Training</option>
    <option value="Resigned" <?php if(strcmp($row['EmpType'],"Resigned")==0){$select6="selected";}else{$select6="";} ?> <?php echo $select6 ?> >Resigned</option>

  </select>

  <div class="section">UserName: </div>
  <input type='text' name='username' id='username' maxlength="50" value="<?php echo $row['UserName'] ?>" />

  <div class="section">Admin*: </div>
  <input type="radio" name="admin" value="yes" <?php if(strcmp($row['Admin'],"yes")==0){$check1="checked";}else{$check1="";} ?> <?php echo    $check1 ?> >Yes
  <input type="radio" name="admin" value="no" <?php if(strcmp($row['Admin'],"no")==0){$check2="checked";}else{$check2="";} ?> <?php echo      $check2 ?> > No

  <div>
  <br>
  <input class="btn btn-submit" type='submit' name='Update' value='Save Changes' onclick="return formValidation();"/> 
  <input class="btn btn-submit" type='submit' name='Cancel' value='Cancel' /> 
  </div>

  </form>
  </div>

</body>

</html>

<?php

// get results from database


$result = sqlsrv_query($conn,"SELECT * FROM empMaster");

// display data in table

echo '<center>';
echo '<p align="center"><h1>Employees</h1></p>';
echo "<table border='1' cellpadding='10' >";

echo "<tr><th>Emp Code</th> <th>Emp Name</th> <th>Designation</th> <th>Emp Type</th><th>User Name</th><th>Admin</th></tr>";




// loop through results of database query, displaying them in the table

while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {

// echo out the contents of each row into a table

echo "<tr>";

echo '<td>' . $row['EmpCode'] . '</td>';

echo '<td>' . $row['EmpName'] . '</td>';

echo '<td>' . $row['Designation'] . '</td>';

echo '<td>' . $row['EmpType'] . '</td>';

echo '<td>' . $row['UserName'] . '</td>';

echo '<td>' . $row['Admin'] . '</td>';


echo "</tr>";

}

echo "</table>";
echo '</center>';

if(isset($_POST['Update'])){

  $code=$_POST['code'];
  $name=$_POST['name'];
  $designation=$_POST['designation'];
  $type=$_POST['type'];
  $username=$_POST['username'];
  $password_temp=$_POST['password'];
  $password=sha1($password_temp);
  $admin=$_POST['admin'];
  $query = "UPDATE empMaster SET EmpName ='$name',Designation='$designation',EmpType='$type',UserName='$username',Admin='$admin' WHERE EmpCode ='$code'";
  $result = sqlsrv_query($conn,$query);
  header('Location: viewEmp.php#bottom'); 
  exit;
}

if(isset($_POST['Cancel'])){

  header('Location: viewEmp.php'); 
  exit;
}

ob_end_flush();
?>