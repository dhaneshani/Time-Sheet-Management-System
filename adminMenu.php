<html>
<head>
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="menu.css" rel="stylesheet" type="text/css">
    <script src="sample-registration-form-validation.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>
  	<link rel="stylesheet" href="css/bootstrap.min.css">
  	<link href="adminForm.css" rel="stylesheet" type="text/css">
  	<link href="table.css" rel="stylesheet" type="text/css">
  	<link rel="stylesheet" type="text/css" href="sweetalert/dist/sweetalert.css">
  	<script src="js/bootstrap.min.js"></script>
  	<script src="sweetalert/dist/sweetalert.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>

    <style>
      a:link {
          color: blue;
          background-color: transparent;
          text-decoration: none;
      }
      a:visited {
          color:purple;
          background-color: transparent;
          text-decoration: none;
      }
      a:hover {
          color: red;
          background-color: transparent;
          text-decoration: underline;
      }
      a:active {
          color: yellow;
          background-color: transparent;
          text-decoration: underline;
      }

      .logoutLblPos{
          position:fixed;
          right:10px;
          top:5px;
      }
    </style>
</head>

<body>
  <form align="right" name="form1" method="post" action="logout.php">
  <label class="logoutLblPos">
  <input name="logout" type="submit" id="submit2" value="log out">
  </label>
  </form>
  
  <div id="content">
    
  <ul id="darkmenu">
          <li><a href="module.php">Module Master</a></li>
          <li><a href="empMaster.php">Employee Master</a></li>
          <li><a href="customerMaster.php">Customer Master</a></li>
          <li><a href="workType.php">Work Type</a></li>
          <li><a href="adminFilter.php">View Time Sheet</a></li>
          
     </ul>
  </div>
<?php
if(isset($_POST['logout'])){

  header('Location: logout.php'); 
  exit;
}  
?>
</body>

</html>