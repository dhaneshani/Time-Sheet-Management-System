<?php
include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>View TimeSheet</title>

</head>
<body>

  <form  action="filter.php" method="POST">
    <input type="hidden" name="hidden1" id="hidden1"  />
    <div>
      <label for="employee">Employee Name:</label>
      <?php
      $query = "SELECT * FROM empMaster";
      $result = sqlsrv_query($conn,$query);
      ?>
      <select id="empMaster" name="empMaster" onchange="function1()">
      <option value=""><None></option>
      <?php while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)):;?>
      <option value="<?php echo $row['EmpName'] ;?>"><?php echo $row['EmpName'] ;?></option>
      <?php endwhile; ?>
      </select>
      <input  id="empCode" name="empCode" placeholder='Code'>
    </div>

    <script>
    
    function function1(){
    var a = document.getElementById("empMaster").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "filter.php?q=" + a, true);
    xmlhttp.send();
    var x = "<?php echo $_SESSION['q']; ?>";
    document.getElementById("empCode").value=x;
    }
    </script>
    <?php
      $q = $_REQUEST["q"];
      $_SESSION['q'] = $q;
    ?>

    
    <div>
      <label for="Date Range">Date Range:</label>
      <input type="date" id="date1" name="date1">
      <label>To</label>
      <input type="date" id="date2" name="date2">
    </div>

    <div>
      <label for="customer">Customer:</label>
      <?php
      $query = "SELECT * FROM customerMaster";
      $result = sqlsrv_query($conn,$query);
      ?>
      <select id="" name="customerMaster" onchange="function2()">
      <option value=""><None></option>
      <?php while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)):;?>
      <option value="<?php echo $row['CustomerName'] ;?>"><?php echo $row['CustomerName'] ;?></option>
      <?php endwhile; ?>
      </select>
      <input  id="customerCode" name="customerCode" placeholder='Code'>
    </div>

    <div>
      <label for="module">Module:</label>
      <?php
      $query = "SELECT * FROM module";
      $result = sqlsrv_query($conn,$query);
      ?>
      <select name="module">
      <option value=""><None></option>
      <?php while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)):;?>
      <option value="<?php echo $row['name'] ;?>"><?php echo $row['name'] ;?></option>
      <?php endwhile; ?>
      </select>
    </div>

    <div>
      <label for="workType">Work Type:</label>
      <?php
      $query = "SELECT * FROM workType";
      $result = sqlsrv_query($conn,$query);
      ?>
      <select name="workType">
      <option value=""><None></option>
      <?php while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)):;?>
      <option value="<?php echo $row['TypeName'] ;?>"><?php echo $row['TypeName'] ;?></option>
      <?php endwhile; ?>
      </select>
    </div>
    <button type="submit" class="btn btn-default">Filter</button>
    <button type="submit" class="btn btn-default">Show All</button>
  </form>
</body>
</html>





