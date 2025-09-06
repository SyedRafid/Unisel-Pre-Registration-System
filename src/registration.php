<?php
include_once('include/config.php');
if (isset($_POST['submit'])) {
	$fname = $_POST['full_name'];
	$sid = $_POST['student_id'];
	$ino = $_POST['ic_no'];
	$intake = $_POST['intake'];
	$cno = $_POST['contact_no'];
	$email = $_POST['email'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$userType = "user";

	if (isset($_POST['submit'])) {
		$pName = $_POST['program'];
		$result = mysqli_query($con, "SELECT pCode FROM program WHERE pName='$pName'");
		$count = mysqli_num_rows($result);
	
		if ($count > 0) {
			$row = mysqli_fetch_assoc($result);
			$program = $row['pCode'];
	}
}
	

	$query = "INSERT INTO user (name, studentId, icno, email, contactNo, intake, pcode, password, userType) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
	$stmt = mysqli_prepare($con, $query);

	mysqli_stmt_bind_param($stmt, "sssssssss", $fname, $sid, $ino, $email, $cno, $intake, $program, $password, $userType);

	if (mysqli_stmt_execute($stmt)) {
		echo "<script>alert('Successfully Registered. You can login now');</script>";
		echo "<script>window.location.href='login.php';</script>";
	} else {
		echo "Error: " . mysqli_error($con);
	}

	mysqli_close($con);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<title>User Registration</title>

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

</head>

<body class="login">
	<div class="row">
		<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="box-register">
				<form name="registration" id="registration" method="post">
					<fieldset>
						<legend>
							Sign Up
						</legend>
						<p>
							Enter your personal details below:
						</p>
						<div class="form-group">
							<input type="text" class="form-control" name="full_name" placeholder="Full Name" required>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="student_id" placeholder="Student ID" required>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="ic_no" placeholder="IC NO" required>
						</div>
						<div class="form-group">
						<select name="program" class="form-control" required="true">
							<option value="">Select Program</option>
							<?php $ret = mysqli_query($con, "select * from program");
							while ($row = mysqli_fetch_array($ret)) {
							?>
								<option value="<?php echo htmlentities($row['pName']); ?>">
									<?php echo htmlentities($row['pName']); ?>
								</option>
							<?php } ?>
						</select>
							</div>
						<div class="form-group">
							<input type="text" class="form-control" name="intake" placeholder="Intake" required>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="contact_no" placeholder="Contact NO" required>
						</div>
						<p>
							Enter your account details below:
						</p>
						<div class="form-group">
							<span class="input-icon">
								<input type="email" class="form-control" name="email" id="email" onBlur="userAvailability()" placeholder="Email" required>
								<i class="fa fa-envelope"></i> </span>
							<span id="user-availability-status1" style="font-size:12px;"></span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
								<i class="fa fa-lock"></i> </span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="password" class="form-control" name="password_again" id="password_again" placeholder="Confirm Password" required>
								<i class="fa fa-lock"></i> </span>
						</div>
						<div class="form-actions">
							<p>
								Already have an account?
								<a href="login.php">
									Log-in
								</a>
							</p>
							<button type="submit" class="btn btn-primary pull-right" id="submit" name="submit">
								Submit <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</fieldset>
				</form>

				<div class="copyright">
					&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> UPRS</span>. <span>All rights reserved</span>
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

	<script>
		function userAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "check_availability.php",
				data: 'email=' + $("#email").val(),
				type: "POST",
				success: function(data) {
					$("#user-availability-status1").html(data);
					$("#loaderIcon").hide();
				},
				error: function() {}
			});
		}
	</script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const form = document.getElementById("registration");

			form.addEventListener("submit", function(event) {
				const password = document.getElementById("password").value;
				const passwordAgain = document.getElementById("password_again").value;

				if (password !== passwordAgain) {
					alert("Passwords do not match. Please re-enter them.");
					event.preventDefault();
				}
			});
		});
	</script>




</body>

</html>