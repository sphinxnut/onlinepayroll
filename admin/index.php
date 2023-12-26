<?php
session_start();
if (isset($_SESSION['admin'])) {
	header('location:home.php');
}
?>

<?php include 'includes/header.php'; ?>
<style>
	body.login-page {
		background-color: #141414;
	}

	b {
		text-align: center;
		font-size: 30px;
		font-weight: bold;
		color: whitesmoke;
	}

	h3,
	img.ok {
		display: block;
		margin-left: auto;
		margin-right: auto;
	}
</style>

<body class="hold-transition login-page">
<<<<<<< HEAD
	<!-- <h3><img src="img/1.png" class="ok" height="130" margin width="500"></h3> -->
=======
	<h3><img src="img/1.png" class="ok" height="130" margin width="500"></h3>
>>>>>>> 9fba41005b837c2dae454214f225d7c95f93ee13
	<div class="login-logo">
		<center><b>Admin Login</b></center>
	</div>
	<div class="login-box">
		<div class="login-box-body">
<<<<<<< HEAD
			<p class="login-box-msg">Sign in to start your work</p>

			<form action="login.php" method="POST">
				<div class="form-group has-feedback">
					<input type="text" class="form-control" name="username" placeholder="input Username" required autofocus>
=======
			<p class="login-box-msg">Sign in to start your session</p>

			<form action="login.php" method="POST">
				<div class="form-group has-feedback">
					<input type="text" class="form-control" name="username" placeholder="input Username" required
						autofocus>
>>>>>>> 9fba41005b837c2dae454214f225d7c95f93ee13
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" name="password" placeholder="input Password" required>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="row">
					<div class="col-xs-4">
<<<<<<< HEAD
						<button type="submit" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
=======
						<button type="submit" class="btn btn-primary btn-block btn-flat" name="login"><i
								class="fa fa-sign-in"></i> Sign In</button>
>>>>>>> 9fba41005b837c2dae454214f225d7c95f93ee13
					</div>
				</div>
			</form>
		</div>
		<?php
<<<<<<< HEAD
		if (isset($_SESSION['error'])) {
			echo "
=======
  		if(isset($_SESSION['error'])){
  			echo "
>>>>>>> 9fba41005b837c2dae454214f225d7c95f93ee13
  				<div class='callout callout-danger text-center mt20'>
			  		<p>" . $_SESSION['error'] . "</p> 
			  	</div>
  			";
<<<<<<< HEAD
			unset($_SESSION['error']);
		}
		?>
=======
  			unset($_SESSION['error']);
  		}
  	?>
>>>>>>> 9fba41005b837c2dae454214f225d7c95f93ee13
	</div>

	<?php include 'includes/scripts.php' ?>
</body>

</html>