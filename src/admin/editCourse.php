<?php
session_start();
unset($_SESSION['msg']);
unset($_SESSION['msgs']);
error_reporting(0);
include('include/config.php');
if (strlen($_SESSION['id'] == 0)) {
	header('location:logout.php');
} else {
	$id = intval($_GET['id']);

	$successMessage = '';
	$errorMessage = '';

	if (isset($_POST['submit'])) {
		$ccode = $_POST['ccode'];
		$cname = $_POST['cname'];
		$sql = mysqli_query($con, "Update course set courseCode='$ccode', courseName='$cname' where  cid='$id'");

		if ($sql) {
			echo '<script>
			if(confirm("Course details updated successfully! Press OK to continue.")){
				window.location = "addCourse.php";
			}
		</script>';
		} else {
			$errorMessage = 'Failed to update course details. Please try again.';
		}
	}




?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Edit Course</title>

		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
		<link rel="icon" href="assets/images/icon1.jpg">
	</head>

	<body>
		<div id="app">
			<?php include('include/sidebar.php'); ?>
			<div class="app-content">

				<?php include('include/header.php'); ?>
				<div class="main-content">
					<div class="wrap-content container" id="container">
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Admin | Edit Course</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Edit Course</span>
									</li>
								</ol>
							</div>
						</section>
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">

									<div class="row margin-top-30">
										<div class="col-lg-6 col-md-12">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Edit Course</h5>
												</div>
												<div class="panel-body">
													<p style="color:red;"><?php echo htmlentities($errorMessage); ?></p>
													<?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
													<form role="form" name="dcotorspcl" method="post">
														<div class="form-group">
															<?php
															$id = intval($_GET['id']);
															$sql = mysqli_query($con, "select * from course where cid='$id'");
															while ($row = mysqli_fetch_array($sql)) {
															?>
																<label for="exampleInputEmail1">
																	Edit Course Code
																	<input type="text" name="ccode" class="form-control" value="<?php echo $row['courseCode']; ?>">
																</label>
																<label for="exampleInputEmail1">
																	Edit Course Name
																	<input type="text" name="cname" class="form-control" value="<?php echo $row['courseName']; ?>">
																</label>
															<?php } ?>
														</div>

														<button type="submit" name="submit" class="btn btn-o btn-primary">
															Update
														</button>
													</form>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="panel panel-white">


								</div>
							</div>
						</div>


					</div>
				</div>
			</div>
		<?php include('include/footer.php'); ?>
		</div>
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<script src="assets/js/main.js"></script>
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
	</body>

	</html>
<?php } ?>