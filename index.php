<?php session_start(); ?>
<?php include 'header.php'; ?>

<head>
  <style>
    body {
      background-color: #141414;
    }

    h3,
    img.ok {
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    p.p1,
    p.p2 {
      color: white;
      font-size: 20px;
    }

    #divvideo {
      box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.1);

    }

    video {
      width: 100%;
      height: auto;
    }
  </style>
  <script type="text/javascript" src="js/instascan.min.js"></script>
</head>
<h3><img src="images/1.png" class="ok" height="130" width="400"></h3>
<div class="login-logo">
  <p class="p1" id="date"></p>
  <p class="p2" id="time" class="bold"></p>
</div>


<div class="login-box">

  <body>
    <div class="login-box-body">

      <h4 class="login-box-msg">Enter Employee ID</h4>

      <form id="attendance">
        <div class="form-group">
          <select class="form-control" name="status">
            <option value="in">Time In</option>
            <option value="out">Time Out</option>
            <option value="leave">Leave Request</option>
            <option value="shift">Shifting Request</option>
            <option value="ot">Overtime</option>
          </select>
        </div>
        <center>
          <p class="login-box-msg"> <i class="glyphicon glyphicon-camera"></i> PLACE YOUR QR CODE HERE</p>
        </center>

        <div>
          <video id="preview" width="300" height="300" style="border-radius:10px;"></video>
        </div>
        <form action="attendance.php" method="post" class="form-horizontal" style="border-radius: 5px;padding:10px;background:#fff;" id="divvideo">
          <i class="glyphicon glyphicon-qrcode"></i> <label>SCAN QR CODE</label>
          <p id="time"></p>
          <input type="text" name="employee" id="text" placeholder="scan qrcode" class="form-control" required autofocus>
          <button type="submit" class="btn btn-primary btn-block btn-flat" id="submit" value="submit"> <i class="fa fa-sign-in"></i> submit</button>
        </form>
        <br>
        <button id="viewBestAttendance" class="btn btn-primary btn-block btn-flat">View Best Attendance of the Month</button>
        <button id="sendfeedback" class="btn btn-primary btn-block btn-flat">Send Feedback</button>

    </div>
    </form>
    <!-- MESSAGE ALERT -->
    <div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
    </div>
    <div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>



</div>

</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  let scanner = new Instascan.Scanner({
    video: document.getElementById('preview')
  });
  Instascan.Camera.getCameras().then(function(cameras) {
    if (cameras.length > 0) {
      scanner.start(cameras[0]);
    } else {
      alert('No cameras found');
    }

  }).catch(function(e) {
    console.error(e);
  });

  scanner.addListener('scan', function(c) {
    document.getElementById('text').value = c;
    document.forms[0].submit();
  });
</script>

<?php include 'scripts.php' ?>

<script type="text/javascript">
  $(function() {
    var interval = setInterval(function() {
      var momentNow = moment();
      $('#date').html(momentNow.format('dddd').substring(0, 3).toUpperCase() + ' - ' + momentNow.format(
        'MMMM DD, YYYY'));
      $('#time').html(momentNow.format('hh:mm:ss A'));
    }, 100);

    /* $('#attendance').submit(function(e) {
      e.preventDefault();
      var attendance = $(this).serialize();
      $.ajax({
        type: 'POST',
        url: 'attendance.php',
        data: attendance,
        dataType: 'json',
        success: function(response) {
          if (response.error) {
            $('.alert').hide();
            $('.alert-danger').show();
            $('.message').html(response.message);
          } else {
            $('.alert').hide();
            $('.alert-success').show();
            $('.message').html(response.message);
            $('#employee').val('');
          }
        }
      });
    }); */
    $(document).ready(function() {
      $('#attendance').submit(function(e) {
        e.preventDefault();
        var status = $('[name="status"]').val();
        if (status === "shift") {
          var employeeId = $('#text').val();
          window.location.href = 'shift_request.php?employee_id=' + employeeId;
        } else if (status === "ot") {
          var employeeId = $('#text').val();
          window.location.href = 'overtime_request.php?employee_id=' + employeeId;
        } else if (status === "leave") {
          var employeeId = $('#text').val();
          window.location.href = 'leave_request.php?employee_id=' + employeeId;
        } else {
          var attendance = $(this).serialize();
          $.ajax({
            type: 'POST',
            url: 'attendance.php',
            data: attendance,
            dataType: 'json',
            success: function(response) {
              if (response.error) {
                $('.alert').hide();
                $('.alert-danger').show();
                $('.message').html(response.message);
              } else {
                $('.alert').hide();
                $('.alert-success').show();
                $('.message').html(response.message);
                $('#employee').val('');
              }
            }
          });
        }
      });
    });

  });

  $(document).ready(function() {
    $('#viewBestAttendance').click(function() {
      window.location.href = 'best_attendance.php'; // Change 'best_attendance.php' to the page where you display the best attendance
    });
  });
  $(document).ready(function() {
    $('#sendfeedback').click(function() {
      window.location.href = 'login.php'; // Change 'best_attendance.php' to the page where you display the best attendance
    });
  });
</script>
</body>

< /html>