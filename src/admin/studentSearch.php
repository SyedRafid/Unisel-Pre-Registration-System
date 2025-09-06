<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen($_SESSION['id'] == 0)) {
	header('location:logout.php');
} else {

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Search Student</title>

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
		<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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
									<h1 class="mainTitle">ADMIN | Search Student</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Search Student</span>
									</li>
								</ol>
							</div>
						</section>
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<form role="form" method="post" name="search">
										<div class="form-group">
											<label for="doctorname">
												Search by Name || Student ID
											</label>
											<input type="text" name="searchdata" id="searchdata" class="form-control trim-space" value="" required='true'>
										</div>
										<button type="submit" name="search" id="submit" class="btn btn-o btn-primary">
											Search
										</button>
									</form>
									<?php
									if (isset($_POST['search'])) {

										$sdata = $_POST['searchdata'];
									?>
										<h4 align="center">Result against "<?php echo $sdata; ?>" keyword </h4>

										<table class="table table-hover" id="sample-table-1">
											<thead>
												<tr>
													<th class="center">#</th>
													<th>Student Name</th>
													<th>Student ID</th>
													<th>IC/Passport</th>
													<th>Program</th>
													<th>Contact No</th>
													<th>Intake</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$sql = mysqli_query($con, "SELECT * FROM user WHERE (name LIKE '%$sdata%' OR studentId LIKE '%$sdata%') AND userType = 'user'");
												$num = mysqli_num_rows($sql);
												if ($num > 0) {
													$cnt = 1;
													while ($row = mysqli_fetch_array($sql)) {
												?>
														<tr>
															<td class="center"><?php echo $cnt; ?>.</td>
															<td class="hidden-xs"><?php echo $row['name']; ?></td>
															<td><?php echo $row['studentId']; ?></td>
															<td><?php echo $row['icno']; ?></td>
															<td><?php echo $row['pCode']; ?></td>
															<td><?php echo $row['contactNo']; ?></td>
															<td><?php echo $row['intake']; ?>
															</td>
															<td>
																<a href="viewStudent.php?id=<?php echo $row['uid']; ?>"><i class="fa fa-eye"></i></a>
															</td>
														</tr>
													<?php
														$cnt = $cnt + 1;
													}
												} else { ?>
													<tr>
														<td colspan="8"> No record found against this search</td>

													</tr>

											<?php }
											} ?>
											</tbody>
										</table>
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
		<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>

		<script>
			$(document).ready(function() {
				$("form").submit(function() {
					$(".trim-space").each(function() {
						var trimmedValue = $.trim($(this).val());
						$(this).val(trimmedValue);
					});
					return true;
				});
			});
		</script>

	</body>

	</html>
<?php } ?>