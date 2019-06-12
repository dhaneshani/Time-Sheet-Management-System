<?php
include('session.php');
include('adminMenu.php');
?>


<!DOCTYPE html>
<html >
<head>
  
  <script type="text/javascript">
  function WkFunction()
  {
  if(document.getElementById('dateRange').selected==true){
    document.getElementById('daterange').hidden = "";
  }else{
  document.getElementById('daterange').hidden = "hidden"; 
  }
  }
  function EmpFunction()
  {
  if(document.getElementById('allEmp').selected==true){
    document.getElementById('selectEmp').hidden = "hidden";
  }else{
  document.getElementById('selectEmp').hidden = ""; 
  var dropdown = document.getElementById("employee");
  var selectedText = dropdown.options[dropdown.selectedIndex].text;
  document.getElementById(selectedText).hidden = "";
  var check = selectedText.concat("check");
  document.getElementById(check).checked = true;

  }
  }
  function CusFunction()
  {
  if(document.getElementById('allCus').selected==true){
    document.getElementById('selectCus').hidden = "hidden";
  }else{
  document.getElementById('selectCus').hidden = ""; 
  var dropdown = document.getElementById("customer");
  var selectedText = dropdown.options[dropdown.selectedIndex].text;
  document.getElementById(selectedText).hidden = "";
  var check = selectedText.concat("check");
  document.getElementById(check).checked = true;
  }
  }
  function ModFunction()
  {
  if(document.getElementById('allMod').selected==true){
    document.getElementById('selectMod').hidden = "hidden";
  }else{
  document.getElementById('selectMod').hidden = ""; 
  var dropdown = document.getElementById("module");
  var selectedText = dropdown.options[dropdown.selectedIndex].text;
  document.getElementById(selectedText).hidden = "";
  var check = selectedText.concat("check");
  document.getElementById(check).checked = true;

  }
  }
  function TypeFunction()
  {
  if(document.getElementById('allType').selected==true){
    document.getElementById('selectType').hidden = "hidden";
  }else{
  document.getElementById('selectType').hidden = ""; 
  var dropdown = document.getElementById("workType");
  var selectedText = dropdown.options[dropdown.selectedIndex].text;
  document.getElementById(selectedText).hidden = "";
  var check = selectedText.concat("check");
  document.getElementById(check).checked = true;
  }
  }
  </script>
</head> 

<body background="image1.jpg">
  <div class="form-style-11">
  <h1>View Detail</h1>
  <form action='adminFilter.php' method='POST'>

    <div class="row">

    <div class="col-sm-6">
    <div class="section">Week:</div>
    <div style="overflow:hidden">
      <?php
      $query = "SELECT DISTINCT(Week) FROM timeSheet";
      $result = sqlsrv_query($conn,$query);
      ?>
      <select id="week" name="week" onchange="WkFunction();">
      <option value="<?php echo date("Y"); ?>">All Weeks</option>
      <option id="dateRange" value="dateRange">Date Range</option>
      <?php while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)):;?>
      <option value="<?php echo $row['Week'] ;?>"><?php echo $row['Week'] ;?></option>
      <?php endwhile; ?>
      </select>
    </div>
    </div>

    <div class="col-sm-6">
    <div id="daterange"  hidden="hidden">
    <div class="section">Date Range:</div >
      <span class="inlineinput" >
      <input type="date" id="date1" name="date1" style='display: inline; width: 215px;'><div class="section">To</div><input type="date" id="date2" name="date2" style='display: inline; width: 215px;'>
      </span>
    </div>
   </div>

  </div>
  <br>
    
  <div class="row">

    <div class="col-sm-3">
    <div class="section">Employee:</div>
    <div style="width:200px; overflow:hidden">
      <select id="employee" name="employee" onchange="EmpFunction();">
        <option id="allEmp" value="allEmployee">All Employees</option>
        <?php
        $query = "SELECT DISTINCT(EmpName) FROM empMaster";
        $result = sqlsrv_query($conn,$query);
        ?>
        <?php while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)):;?>
        <option value="<?php echo $row['EmpName'] ;?>"><?php echo $row['EmpName'] ;?></option>
        <?php endwhile;?>
      </select>
    </div>

    <div id="selectEmp"  hidden="" style="max-height: 200px;overflow-y: auto;">
      <?php
      $query = "SELECT DISTINCT(EmpName) FROM empMaster";
      $result = sqlsrv_query($conn,$query);
      ?>
      <?php while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)):;?>
      <div id="<?php echo $row['EmpName'] ;?>" hidden="hidden" class="section"><input id="<?php echo $row['EmpName'],"check" ;?>" type="checkbox" id="emp" name="emp_list[]" value="<?php echo $row['EmpName'] ;?>"><?php echo $row['EmpName'] ;?></div>
      <?php endwhile; ?>
    </div>
    </div>

    <div class="col-sm-3">
    <div class="section">Customer:</div>
    <div style="width:200px; overflow:hidden">
      <select id="customer" name="customer" onchange="CusFunction();">
        <option id="allCus" value="allCustomer">All Customers</option>
        <?php
        $query = "SELECT DISTINCT(CustomerName) FROM customerMaster";
        $result = sqlsrv_query($conn,$query);
        ?>
        <?php while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)):;?>
        <option value="<?php echo $row['CustomerName'] ;?>"><?php echo $row['CustomerName'] ;?></option>
        <?php endwhile;?>
      </select>
    </div>

    <div id="selectCus"  hidden="" style="max-height: 200px;overflow-y: auto;">
      <?php
      $query = "SELECT DISTINCT(CustomerName) FROM customerMaster";
      $result = sqlsrv_query($conn,$query);
      ?>
      <?php while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)):;?>
      <div id="<?php echo $row['CustomerName'] ;?>" hidden="hidden" class="section"><input id="<?php echo $row['CustomerName'],"check" ;?>" type="checkbox" id="cus" name="cus_list[]" value="<?php echo $row['CustomerName'] ;?>"><?php echo $row['CustomerName'] ;?></div>
      <?php endwhile; ?>
    </div>
    </div>

    <div class="col-sm-3">
    <div class="section">Module:</div>
    <div style="width:200px; overflow:hidden" >
      <select id="module" name="module" onchange="ModFunction();">
        <option id="allMod" value="allModule">All Modules</option>
        <?php
        $query = "SELECT DISTINCT(name) FROM module";
        $result = sqlsrv_query($conn,$query);
        ?>
        <?php while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)):;?>
        <option value="<?php echo $row['name'] ;?>"><?php echo $row['name'] ;?></option>
        <?php endwhile;?>
      </select>
    </div>

    <div id="selectMod"  hidden="" style="max-height: 200px;overflow-y: auto;">
      <?php
      $query = "SELECT DISTINCT(name) FROM module";
      $result = sqlsrv_query($conn,$query);
      ?>
      <?php while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)):;?>
      <div id="<?php echo $row['name'] ;?>" hidden="hidden" class="section"><input id="<?php echo $row['name'],"check" ;?>" type="checkbox" id="mod" name="mod_list[]" value="<?php echo $row['name'] ;?>"><?php echo $row['name'] ;?></div>
      <?php endwhile; ?>
    </div>
    </div>

    <div class="col-sm-3">
    <div class="section">Work Type:</div>
    <div style="width:200px; overflow:hidden">
      <select id="workType" name="workType" onchange="TypeFunction();">
        <option id="allType" value="allWorkType">All Work Types</option>
        <?php
        $query = "SELECT DISTINCT(TypeName) FROM workType";
        $result = sqlsrv_query($conn,$query);
        ?>
        <?php while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)):;?>
        <option value="<?php echo $row['TypeName'] ;?>"><?php echo $row['TypeName'] ;?></option>
        <?php endwhile;?>
      </select>
    </div>

    <div id="selectType"  hidden="" style="max-height: 200px;overflow-y: auto;">
      <?php
      $query = "SELECT DISTINCT(TypeName) FROM workType";
      $result = sqlsrv_query($conn,$query);
      ?>
      <?php while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)):;?>
      <div id="<?php echo $row['TypeName'] ;?>" hidden="hidden" class="section"><input id="<?php echo $row['TypeName'],"check" ;?>" type="checkbox" id="type" name="type_list[]" value="<?php echo $row['TypeName'] ;?>"><?php echo $row['TypeName'] ;?></div>
      <?php endwhile; ?>
    </div>
    </div>

    </div>

    <div>
    <br>
    <input type='submit' name='Submit' value='View'>
    <input type='submit' name='Cancel' value='Cancel'>
    </div>
  
  </form>
  </div>

</body>

</html>

<?php
if(isset($_POST['Submit'])){

  $week=$_POST['week'];
  $date1=$_POST['date1'];
  $date2=$_POST['date2'];
  $employee=$_POST['employee'];
  $customer=$_POST['customer'];
  $module=$_POST['module'];
  $workType=$_POST['workType'];
  $emp_Array=array();
  $cus_Array=array();
  $mod_Array=array();
  $type_Array=array();

  
    if($employee=="allEmployee"){
      $query = "SELECT DISTINCT(EmpName) FROM empMaster";
      $result = sqlsrv_query($conn,$query);
      while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
      $emp_Array[] = $row['EmpName']; 
      }
    }else{
      if(isset($_POST['emp_list'])){
        $checked = $_POST['emp_list'];
        foreach($checked as $employee) {
        $emp_Array[] = $employee;
        }
      } 
    }
  

  
    if($customer=="allCustomer"){
      $query = "SELECT DISTINCT(CustomerName) FROM CustomerMaster";
      $result = sqlsrv_query($conn,$query);
      while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
      $cus_Array[] = $row['CustomerName']; 
      }
    }else{
      if(isset($_POST['cus_list'])){
        $checked = $_POST['cus_list'];
        foreach($checked as $customer){
        $cus_Array[] = $customer;
        }
      }
    }
  

  if($module=="allModule"){
    $query = "SELECT DISTINCT(name) FROM module";
    $result = sqlsrv_query($conn,$query);
    while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $mod_Array[] = $row['name']; 
    }
  }else{
    if(isset($_POST['mod_list'])){
      $checked = $_POST['mod_list'];
      foreach($checked as $module) {
      $mod_Array[] = $module;
      }
    }
  }

  if($workType=="allWorkType"){
    $query = "SELECT DISTINCT(TypeName) FROM workType";
    $result = sqlsrv_query($conn,$query);
    while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)){
    $type_Array[] = $row['TypeName']; 
    }
  }else{
    if(isset($_POST['type_list'])){
      $checked = $_POST['type_list'];
      foreach($checked as $type) {
      $type_Array[] = $type;
      }
    }
  }

  
  if(!isset($week) || trim($week) == ''||empty($emp_Array)||empty($cus_Array)||empty($mod_Array)||empty($type_Array))
  {

      echo "<script type=\"text/javascript\">";
      echo "sweetAlert('Sorry!','You did not fill out the required fields.','warning');";
      //echo "showData();";
      echo "</script>";

  }elseif($week=="dateRange"&&(!isset($date1) || trim($date1) == ''||!isset($date2) || trim($date2) == '')){
    

      echo "<script type=\"text/javascript\">";
      echo "sweetAlert('Sorry!','Please enter a date range.','warning');";
      //echo "showData();";
      echo "</script>";

    

  }
  else{

    $imploded_employee=array();
    $imploded_customer=array();
    $imploded_module=array();
    $imploded_type=array();
    foreach($emp_Array as $emp){
      $imploded_employee[] = "'".$emp."'";
    }
    foreach($cus_Array as $cus){
      $imploded_customer[] = "'".$cus."'";
    }
    foreach($mod_Array as $mod){
      $imploded_module[] = "'".$mod."'";
    }
    foreach($type_Array as $type){
      $imploded_type[] = "'".$type."'";
    }
    $imploded_employee = implode(',', $imploded_employee);
    $imploded_customer = implode(',', $imploded_customer);
    $imploded_module = implode(',', $imploded_module);
    $imploded_type = implode(',', $imploded_type);

    $_SESSION['week']=$week;
    $_SESSION['date1']=$date1;
    $_SESSION['date2']=$date2;
    $_SESSION['employee'] = $imploded_employee;
    $_SESSION['customer'] = $imploded_customer;
    $_SESSION['module'] = $imploded_module;
    $_SESSION['type'] = $imploded_type;
    
    if($week!="dateRange"){
      $query = "SELECT * FROM timeSheet WHERE Employee IN ($imploded_employee) AND Customer IN ($imploded_customer) AND Module IN ($imploded_module) AND WorkType IN ($imploded_type) AND Week LIKE  '%{$week}%' AND Confirmation='Yes' ";
      $result=sqlsrv_query($conn,$query);

    }else{
      $query = "SELECT * FROM timeSheet WHERE Employee IN ($imploded_employee) AND Customer IN ($imploded_customer) AND Module IN ($imploded_module) AND WorkType IN ($imploded_type) AND Day BETWEEN  '$date1' AND '$date2' AND Confirmation='Yes'";
      $result=sqlsrv_query($conn,$query);
    }
    
    
    echo '<br>';
    echo '<center>';

    echo "<table border='1' cellpadding='10'>";

    echo "<tr><th>Week</th><th>Date</th><th>Employee</th><th>Customer</th><th>Module</th><th>Work Type</th><th>Description</th><th>Start Time</th><th>End Time</th><th>Duration</th></tr>";
    $diff=0;
    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {


    echo "<tr>";

    echo '<td>' . $row['Week'] . '</td>';

    echo '<td>' . $row['Day'] . '</td>';

    echo '<td>' . $row['Employee'] . '</td>';

    echo '<td>' . $row['Customer'] . '</td>';

    echo '<td>' . $row['Module'] . '</td>';

    echo '<td>' . $row['WorkType'] . '</td>';

    echo '<td>' . $row['Description'] . '</td>';

    echo '<td>' . $row['StartTime'] . '</td>';

    echo '<td>' . $row['EndTime'] . '</td>';

    echo '<td>' . $row['Duration'] . '</td>';

    $time1=strtotime($row['StartTime']);
    $time2=strtotime($row['EndTime']);
    $diff=$diff+($time2-$time1)/60;

    echo "</tr>";

    }
    
    echo "</table>";

    function convertToHoursMins($time, $format = '%02d:%02d'){
      if ($time < 1) {
          return;
      }
      $hours = floor($time / 60);
      $minutes = ($time % 60);
      return sprintf($format, $hours, $minutes);
    }

    $total=convertToHoursMins($diff, '%02d hours %02d minutes');

    $_SESSION['totalTime']=$total;

    echo "<tr>Total Time Duration: $total</tr><br>";

    echo '<a href="adminReportPdf.php"  target="_blank">Download as pdf</a>';

    echo '</center>';
    
    
    }
  
}

if(isset($_POST['Cancel'])){
  
    
}

?>
