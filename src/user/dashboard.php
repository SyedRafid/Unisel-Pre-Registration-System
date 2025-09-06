<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen(($_SESSION['id'] == 0) || (strlen($_SESSION['login'] == 0)))) {
	header('location:logout.php');
} else {
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Dashboard</title>

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
									<h1 class="mainTitle">Student | Dashboard</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Student</span>
									</li>
									<li class="active">
										<span>Dashboard</span>
									</li>
								</ol>
							</div>
						</section>
						<div class="container-fluid container-fullw bg-white">
							<div class="row">


								<div class="item-content">
									<div class="item-media" style="font-size: 24px;">
										<i class="ti-arrow-right"></i>
									</div>
									<div class="item-inner" style="font-size: 24px; font-family: serif;">
										<span class="title">Ongoing Pre-Registration</span>
									</div>
								</div>
								<div class="container">
									<?php
									$sql = "SELECT * FROM `semester` WHERE `status` = 2;";
									$result = mysqli_query($con, $sql);

									if (!$result) {
										echo "Error: " . mysqli_error($con);
									} else {
										$count = 0;

										while ($row = mysqli_fetch_assoc($result)) {
											if ($count % 3 == 0) {
												echo '<div class="row">';
											}
											$sid = $row['sid'];

									?>
											<div class="col-sm-4">
												<?php
												$uid = $_SESSION['id'];
												$sidToCheck = $sid;
												$sql = "SELECT `sid` FROM `semestercourse` WHERE `uid` = '$uid'";
												$resultCheck = mysqli_query($con, $sql);
												$existingSids = array();

												if ($resultCheck) {
													while ($rowCheck = mysqli_fetch_assoc($resultCheck)) {
														$existingSids[] = $rowCheck['sid'];
													}
												}

												if (in_array($sidToCheck, $existingSids)) {
													echo '<div onclick="showAlreadyCompletedAlert();" style="cursor: pointer;">';
												} else {
													echo '<a href="addCourse.php?sid=' . $sidToCheck . '">';
												}
												?>
												<div class="panel panel-white no-radius text-center" style="background: linear-gradient(to top, rgba(104, 255, 72, 0.30), rgba(0, 0, 0, 0));">
													<div class="panel-body" style="height: 200px;">
														<span class="fa-stack fa-2x">
															<i class="fa fa-square fa-stack-2x text-primary"></i>
															<i class="fa fa-terminal fa-stack-1x fa-inverse"></i>
														</span>
														<h2 class="StepTitle" style="font-size: 29px;"><?php echo htmlentities($row['semesterName']); ?></h2>
														<p class="links cl-effect-1">
															<?php echo 'Semester Code: ' . htmlentities($row['SemesterCode']); ?>
														</p>
														<?php
														$endDate = new DateTime($row['endDate']);
														$formattedDate = $endDate->format('F j, Y');
														?>
														<p class="links cl-effect-1" style="font-weight: bold;">
															<?php echo 'Ends on ' . htmlentities($formattedDate); ?>
														</p>
													</div>
												</div>
												<?php
												if (in_array($sidToCheck, $existingSids)) {
													echo '</div>';
												} else {
													echo '</a>';
												}
												?>
											</div>
									<?php
											$count++;
											if ($count % 3 == 0) {
												echo '</div>';
											}
										}

										if ($count % 3 != 0) {
											echo '</div>';
										}
									}
									?>
								</div>



								<div class="item-content">
									<div class="item-media" style="font-size: 24px;">
										<i class="ti-arrow-right"></i>
									</div>
									<div class="item-inner" style="font-size: 24px; font-family: serif;">
										<span class="title">Upcoming Pre-Registration</span>
									</div>
								</div>

								<div class="container">
									<?php
									$sql = "SELECT * FROM `semester` WHERE `status` = 1;";
									$result = mysqli_query($con, $sql);
									if (!$result) {
										echo "Error: " . mysqli_error($con);
									} else {
										$count = 0;

										while ($row = mysqli_fetch_assoc($result)) {
											if ($count % 3 == 0) {
												echo '<div class="row">';
											}
									?>
											<div class="col-sm-4">
												<div class="panel panel-white no-radius text-center" style="background: linear-gradient(to top, rgba(255, 0, 0, 0.2), rgba(0, 0, 0, 0));">
													<div class="panel-body" style="height: 200px;">
														<span class="fa-stack fa-2x">
															<i class="fa fa-square fa-stack-2x text-primary"></i>
															<i class="fa fa-terminal fa-stack-1x fa-inverse"></i>
														</span>
														<h2 class="StepTitle" style="font-size: 29px;"><?php echo htmlentities($row['semesterName']); ?></h2>
														<p class="links cl-effect-1">
															<?php echo 'Semester Code: ' . htmlentities($row['SemesterCode']); ?>
														</p>
														<?php
														$startDate = new DateTime($row['startDate']);
														$startDate->modify('+1 minute');
														$formattedDated = $startDate->format('F j, Y');
														?>
														<p class="links cl-effect-1" style="font-weight: bold;">
															<?php echo 'Starts on ' . htmlentities($formattedDated); ?>
														</p>
													</div>
												</div>
											</div>
									<?php
											$count++;
											if ($count % 3 == 0) {
												echo '</div>';
											}
										}

										if ($count % 3 != 0) {
											echo '</div>';
										}
									}
									?>
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
		<script>
			function showAlreadyCompletedAlert() {
				alert('You have already completed the pre-registration.');
			}
		</script>

	</body>

	</html>
<?php } ?>