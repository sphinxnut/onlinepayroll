<?php session_start(); ?>
<?php include 'header.php'; ?>
<head>
<style>
	body{
		background-color: #141414;  
	}
	h3,img.ok{
  display: block;
  margin-left: auto;
  margin-right: auto;
  }
  p.p1,p.p2{
    color: white;
    font-size: 20px;
  }
  #divvideo{
			 box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.1);
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
    	<!-- <h4 class="login-box-msg">Enter Employee ID</h4> -->

    	<form id="attendance">
          <div class="form-group">
            <select class="form-control" name="status">
              <option value="in">Time In</option>
              <option value="out">Time Out</option>
            </select>
          </div>
      		<div class="form-group has-feedback">
        		 <input type="text" class="form-control input-lg" id="employee" name="employee" required> 
        		<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
      		</div>
          <center><p class="login-box-msg"> <i class="glyphicon glyphicon-camera"></i> TAP HERE</p></center>
              <div id="divvideo">
			       <video id="preview" width="300" height="261" style="border-radius:10px;"></video> <br> <br>
              </div>
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="signin"><i class="fa fa-sign-in"></i> Sign In</button>
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
	<script>
           let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
           Instascan.Camera.getCameras().then(function(cameras){
               if(cameras.length > 0 ){
                   scanner.start(cameras[0]);
               } else{
                   alert('No cameras found');
               }

           }).catch(function(e) {
               console.error(e);
           });

           scanner.addListener('scan',function(c){
               document.getElementById('text').value=c;
               document.forms[0].submit();
           });
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