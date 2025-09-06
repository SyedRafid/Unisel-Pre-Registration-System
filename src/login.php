<?php
session_start();
include("include/config.php");

if (isset($_POST['submit'])) {
	$puname = $_POST['username'];
	$ppwd = $_POST['password'];

	if (empty($puname) || empty($ppwd)) {
		$_SESSION['errmsg'] = "Username and password are required.";
		header("location: login.php");
		exit;
	}

	$query = "SELECT * FROM user WHERE email=?";
	$stmt = mysqli_prepare($con, $query);
	mysqli_stmt_bind_param($stmt, "s", $puname);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if ($num = mysqli_fetch_assoc($result)) {
		if (password_verify($ppwd, $num['password'])) {
			// Password is correct
			date_default_timezone_set('Asia/Singapore');
			$currentDateTime = date('Y-m-d H:i:s');
			$idate = date('d-m-Y h:i:s A', time());
			$_SESSION['login'] = $puname;
			$_SESSION['id'] = $num['uid'];
			$pid = $num['uid'];
			$userType = $num['userType'];
			$host = $_SERVER['HTTP_HOST'];
			$uip = $_SERVER['REMOTE_ADDR'];
			$status = 1;

			$log = mysqli_query($con, "insert into userlog(uid, username, userip, loginTime, status) values('$pid', '$puname', '$uip', '$idate', '$status')");

			if ($userType == 'admin') {
				header("location: admin/dashboard.php");
			} elseif ($userType == 'user') {
				header("location: user/dashboard.php");
			} else {
				echo "<script>alert('Invalid User Type !!');</script>";
				header("location: login.php");
			}
		} else {
			date_default_timezone_set('Asia/Singapore');
			$currentDateTime = date('Y-m-d H:i:s');
			$idate = date('d-m-Y h:i:s A', time());
			$_SESSION['login'] = $_POST['username'];
			$uip = $_SERVER['REMOTE_ADDR'];
			$_SESSION['id'] = $num['uid'];
			$pid = $num['uid'];
			$status = 0;
			mysqli_query($con, "insert into userlog(uid, username, userip, loginTime, status) values('$pid','$puname', '$uip', '$idate', '$status')");
			echo '<script>
				if(confirm("Invalid username or password! Press OK to continue.")){
					window.login.php";
				}
			</script>';
		}
	} else {
		date_default_timezone_set('Asia/Singapore');
		$currentDateTime = date('Y-m-d H:i:s');
		$idate = date('d-m-Y h:i:s A', time());
		$_SESSION['login'] = $_POST['username'];
		$uip = $_SERVER['REMOTE_ADDR'];
		$status = 0;
		mysqli_query($con, "insert into userlog(username, userip, loginTime, status) values('$puname', '$uip', '$idate', '$status')");
		echo '<script>
		if(confirm("Invalid username or password! Press OK to continue.")){
			window.login.php";
		}
	</script>';
	}
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login Panel</title>

	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
	<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
	<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
	<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="assets/css/styles.css">
	<link rel="stylesheet" href="assets/css/plugins.css">
	<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
	<link rel="icon" href="assets/images/icon1.jpg">
	<style>
		body {
			background: url(assets/images/unisel.jpg);
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			background-attachment: fixed;
		}
	</style>

	</style>
</head>

<body class="login">
	<div class="row">
		<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="box-login">
				<div class="logo margin-top-30">
					<div class="white-translucent-layer">
						<a href="index.php">
							<h2> UPRS | Login Panel</h2>
						</a>
					</div>
				</div>



				<form class="form-login" method="post" action="login.php">
					<fieldset>
						<legend>
							Sign in to your account
						</legend>
						<p>
							Please enter your name and password to log in.<br />
						</p>
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" name="username" placeholder="Email">
								<i class="fa fa-user"></i> </span>
						</div>
						<div class="form-group form-actions">
							<span class="input-icon">
								<input type="password" class="form-control password" name="password" placeholder="Password">
								<i class="fa fa-lock"></i>
							</span><a href="forgot-password.php">
								Forgot Password ?
							</a>
						</div>
						<div class="form-actions">

							<button type="submit" class="btn btn-primary pull-right" name="submit">
								Login <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
						<div class="new-account">
							Don't have an account yet?
							<a href="registration.php">
								Create an account
							</a>
						</div>
					</fieldset>
				</form>

				<div class="copyright">
					&copy;<span class="text-bold text-uppercase">Unisel Pre-Registration System</span>.
				</div>

			</div>

		</div>
	</div>
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/modernizr/modernizr.js"></script>
	<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="vendor/switchery/switchery.min.js"></script>
	<script src="vendor/jquery-validation/jquery.validate.min.js"></script>

	<script src="assets/js/main.js"></script>

	<script src="assets/js/login.js"></script>
	<script>
		jQuery(document).ready(function() {
			Main.init();
			Login.init();
		});
	</script>

</body>

</html>