<?php
include('session.php');
include('adminMenu.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>Employee Master</title>
    
</head>

<body background="image1.jpg">
 
<div class="form-style-10">
<h1>Employee Master</h1>
<form name="registration" id='register' onSubmit="return formValidation();"  action='empMaster.php' method='post'
    accept-charset='UTF-8' class="STYLE-NAME">

<div class="section">Employee Code*: </div>
<input type='text' name='code' id='code' maxlength="50" />

<div class="section">Employee Name*: </div>
<input type='text' name='name' id='name' maxlength="50" />

<div class="section">Designation*: </div>
<input type='text' name='designation' id='designation' maxlength="50" />

<div class="section">Employee Type*: </div>
<select name='type'>
  <option value="Permenent">Permenent</option>
  <option value="Probation">Probation</option>
  <option value="Contract">Contract</option>
  <option value="Internship">Internship</option>
  <option value="Training">Training</option>
  <option value="Resigned">Resigned</option>
</select>

<div class="section">User Name*: </div>
<input type='text' name='username' id='username' maxlength="50" />

<div class="section">Password*: </div>
<input type='text' name='password' id='password' maxlength="50" />

<div class="section">Admin*: </div>
<input type="radio" name="admin" value="yes">Yes
<input type="radio" name="admin" value="no"> No
<br>
<br>

<div>
<input class="btn btn-submit" type='submit' name='Submit' value='Submit' />
<a href="viewEmp.php#bottom">View Employees</a>
</div>

</form>
</div>

</body>
</html> 
  
<?php
if(isset($_POST['Submit'])){
	$code=$_POST['code'];
	$name=$_POST['name'];
	$designation=$_POST['designation'];
	$type=$_POST['type'];
	$username=$_POST['username'];
	$password_temp=$_POST['password'];
	$password=sha1($password_temp);
	$admin=$_POST['admin'];
  $query1= "SELECT * FROM empMaster WHERE EmpCode='$code'";
  $result1 = sqlsrv_query($conn,$query1);
  $row = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC);
  if (count($row)== 0){
  $query2 = "INSERT INTO empMaster (EmpCode,EmpName,Designation,EmpType,UserName,Password,Admin) VALUES ('$code','$name','$designation','$type','$username','$password','$admin')";
  $result2 = sqlsrv_query($conn,$query2);
  header('Location: viewEmp.php#bottom'); 
  exit;
  }else{
        echo "
            <script type=\"text/javascript\">
            alert('This Employee is already Exit.');
            </script>
        ";
  }

}  
 
?>
