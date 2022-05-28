<?php include 'includes/session.php'; ?>

<?php
  include '../timezone.php';
  $range_to = date('m/d/Y');
  $range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
?>

<?php include 'includes/header.php'; ?>


<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Schedules
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Employees</li>
        <li class="active">Schedules</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="pull-right">
                <form method="POST" class="form-inline" id="scheduleForm">

                <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range" value="<?php echo (isset($_GET['date'])) ? $_GET['date'] : $range_from.' - '.$range_to; ?>">
                  </div>

                  <!-- <div class="form-group">
                      <label>Select Schedule: </label>
                      <select class="form-control" id="schedule" name="schedule" required>
                        <option value="" selected>- Select -</option>
                        <?php
                          $sql = "SELECT * FROM schedules";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['id']."'>".date('h:i A', strtotime($srow['time_in'])).' - '.date('h:i A', strtotime($srow['time_out']))."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div> -->
                    <button type="button" class="btn btn-success btn-sm btn-flat" id="schedulePrint"><span class="glyphicon glyphicon-print"></span> Print</button>
                    
                <!-- <a href="schedule_print.php" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span> </a> -->

               
                </form>
              </div>
            </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Employee ID</th>
                  <th>Name</th>
                  <th>Schedule</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php 
                      $sql;
                      if(isset($_GET['date'])){
                        $range = $_GET['date'];
                        $ex = explode(' - ', $range);
                        $from = date('Y-m-d', strtotime($ex[0]));
                        $to = date('Y-m-d', strtotime($ex[1]));
                        // echo '<script>alert('. $to.')</script>';

                        $sql = "SELECT *, employees.id AS empid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE attendance.date BETWEEN '$from' AND '$to'ORDER BY employees.updated_on DESC";

                      }else{
                        $sql = "SELECT *, employees.id AS empid FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id ORDER BY employees.updated_on DESC";
                      }
                      
                    $query = $conn->query($sql);

                    while($row = $query->fetch_assoc()){
                      
                      echo "
                        <tr>
                          <td>".$row['employee_id']."</td>
                          <td>".$row['firstname'].' '.$row['lastname']."</td>
                          <td>".date('h:i A', strtotime($row['time_in'])).' - '.date('h:i A', strtotime($row['time_out']))."</td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['empid']."'><i class='fa fa-edit'></i> Edit</button>
                          </td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/employee_schedule_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $("#reservation").on('change', function(){
    var date = encodeURI($(this).val());
    window.location = 'schedule_employee.php?date='+date;
  });


// $("#reservation").on('change', function(){
//     var range = encodeURI($(this).val());
//     window.location = 'schedule_employee.php?range='+range;
// });

  $('#schedulePrint').click(function(e){
      e.preventDefault();
      $('#scheduleForm').attr('action', 'schedule_print.php');
      $('#scheduleForm').submit();
    });

});



function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'schedule_employee_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.employee_name').html(response.firstname+' '+response.lastname);
      $('#schedule_val').val(response.schedule_id);
      $('#schedule_val').html(response.time_in+' '+response.time_out);
      $('#empid').val(response.empid);
    }
  });
}
</script>
</body>
</html>
