<?php
include('session.php');
include('adminMenu.php');
?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Module Master</title>
</head>

<body background="image1.jpg">

  <div class="form-style-10">
  <h1>Module Master</h1>
    <form name='registration' onSubmit="return formValidation();" id='register' action='module.php' method='post'
    accept-charset='UTF-8' class="STYLE-NAME">
      
            
            <div class="section">Module Code*:</div>
            <input type='text' name='code' id='code' maxlength="50" />

            <div class="section">Module Name*:</div>
            <input type='text' name='name' id='name' maxlength="50" />
          
            <br>
            <input class="btn btn-submit" type="submit" name='Submit' value="Submit" />
            <a href="view.php#bottom">View Modules</a>
          
    </form>  
  </div>

<?php


  if(isset($_POST['Submit'])){
    $code=$_POST['code'];
    $name=$_POST['name'];
    $query1= "SELECT * FROM module WHERE code='$code'";
    $result1 = sqlsrv_query($conn,$query1);
    $row = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC);
    if (count($row)== 0){
    $query2 = "INSERT INTO module (code,name) VALUES ('$code','$name')";
    $result2 = sqlsrv_query($conn,$query2);
    header('Location: view.php#bottom'); 
    exit;
    }else{
          echo "
              <script type=\"text/javascript\">
              alert('This Module is already Exit.');
              </script>
          ";
    }

  }
?>   
</body>
</html>
