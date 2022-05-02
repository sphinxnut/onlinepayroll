<?php session_start(); ?>
<?php include 'header.php'; ?>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
        #preview { padding:30px; border:1px solid; background:#3d3d3d; }
    </style>
</head>
<body style="background-color: black"class="hold-transition login-page">
<div class="login-box">
  	<div class="login-logo">
  		<p style="color:#00ffbf" id="date"></p>
      <p style="color:white" id="time" class="bold"></p>
  	</div>
  
  	<div class="login-box-body">
    	<h4 class="login-box-msg">Enter Employee ID</h4>

    	<form id="attendance">
          <div class="form-group">
            <select class="form-control" name="status">
              <option value="in">Time In</option>
              <option value="in">Break In</option>
              <option value="out">Break Out</option>
              <option value="out">Time Out</option>
            </select>
          </div>
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control input-lg" id="employee" name="employee" required>
        		<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
      		</div>
          
      		<div class="row">

          <div class="container">
            <!-- Nested form tag not needed -->
          <!-- <form method="POST" action="saveUploadImg.php"> -->
        <div class="row pakainfo">
            <div class="col-md-6 pakainfo">
                <div id="live_camera"></div>
                <hr/>
                <input type=button value="Take Snapshot" onClick="capture_web_snapshot()">
                <input type="hidden" name="image" class="image-tag">
                <button type="submit" class="btn btn-primary btn-block btn-flat" name="signin"><i class="fa fa-sign-in"></i> Submit </button>
                 
            </div>
            <div class="col-md-6">
                <div id="preview">Your captured image will appear here...</div>
            </div>
            <div class="col-md-12 text-center pakainfo">
                <br/>
      
            </div>
        </div>
    <!-- </form> -->
</div>
    			<div class="col-xs-4">
          			
        		</div>
      		</div>
    	</form>
  	</div>
		<div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
    </div>
		<div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>
  		
</div>
<!-- Settings a few settings and (php capture image from camera) web attach camera -->
<script language="JavaScript">
    Webcam.set({
        width: 320,
        height: 390,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#live_camera' );
  
    function capture_web_snapshot() {
        Webcam.snap( function(site_url) {
            $(".image-tag").val(site_url);
            document.getElementById('preview').innerHTML = '<img src="'+site_url+'"/>';
        } );
    }
</script>
	
<?php include 'scripts.php' ?>
<script type="text/javascript">
$(function() {
  var interval = setInterval(function() {
    var momentNow = moment();
    $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));  
    $('#time').html(momentNow.format('hh:mm:ss A'));
  }, 100);

  $('#attendance').submit(function(e){
    e.preventDefault();
    var attendance = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'attendance.php',
      data: attendance,
      dataType: 'json',
      success: function(response){
        if(response.error){
          $('.alert').hide();
          $('.alert-danger').show();
          $('.message').html(response.message);
        }
        else{
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message);
          $('#employee').val('');
        }
      }
    });
  });
});
</script>
</body>
</html>