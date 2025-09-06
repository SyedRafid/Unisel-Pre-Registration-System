<?php
session_start();
unset($_SESSION['msg']);
unset($_SESSION['msgs']);
error_reporting(0);
include('include/config.php');

if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {
    if (!isset($_SESSION['msg'])) {
        $_SESSION['msg'] = ""; 
    }
    if (!isset($_SESSION['msgs'])) {
        $_SESSION['msgs'] = ""; 
    }

    if (isset($_POST['submit'])) {
        $scode = $_POST['scode'];
        $sname = $_POST['sname'];
        $result = mysqli_query($con, "(SELECT sid FROM semester WHERE sid='$scode')");
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            $_SESSION['msgs'] = "Semester code already exists!!";
        } else {
            $sql = mysqli_query($con, "insert into semester(SemesterCode, semesterName) values('$scode', '$sname')");

            if ($sql) {
                $_SESSION['msg'] = "Semester added successfully !!";
            } else {
                $_SESSION['msgs'] = "Failed to add semester. Please try again.";
            }
        }
    }

	if (isset($_GET['del'])) {
		$sid = $_GET['sid'];
		$result = mysqli_query($con, "delete from semester where sid = '$sid'");
	
		if ($result) {
			echo '<script>
				if(confirm("Semester data deleted successfully! Press OK to continue.")){
					window.location = "addSemester.php";
				}
			</script>';
		} else {
			echo '<script>
				if(confirm("Failed to delete semester data. Please try again. Press OK to continue.")){
					window.location = "addSemester.php";
				}
			</script>';
		}
	}
	
?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Manage Semester</title>

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
									<h1 class="mainTitle">Admin | Manage Semester</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Manage Semester</span>
									</li>
								</ol>
							</div>
						</section>
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">

									<div class="row margin-top-5">
										<div class="col-md-12">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Add Semester</h5>
												</div>
												<div class="panel-body">
													<p style="color:green;"><?php echo htmlentities($_SESSION['msg']); ?></p>
													<p style="color:red;"><?php echo htmlentities($_SESSION['msgs']); ?></p>
													<form role="form" name="dcotorspcl" method="post">
														<div class="form-row">
															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputEmail1">Enter Semester Code</label>
																	<input type="text" name="scode" class="form-control" placeholder="Semester Code" required>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputEmail1">Enter Semester Name</label>
																	<input type="text" name="sname" class="form-control" placeholder="Semester Name" required>
																</div>
															</div>
														</div>
														<button type="submit" name="submit" class="btn btn-o btn-primary">Submit</button>
													</form>
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
							<div class="row">
								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Semester List</span></h5>

									<table class="table table-hover" id="sample-table-1">
										<thead>
											<tr>
												<th class="center">#</th>
												<th>Semester code</th>
												<th>Semester Name</th>
												<th>Creation Date</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sql = mysqli_query($con, "select * from semester ORDER BY `semester`.`CreationDate` ASC ");
											$cnt = 1;
											while ($row = mysqli_fetch_array($sql)) {
											?>
												<tr>
													<td class="center"><?php echo $cnt; ?>.</td>
													<td><?php echo $row['SemesterCode']; ?></td>
													<td><?php echo $row['semesterName']; ?></td>
													<td><?php echo $row['CreationDate']; ?>
													</td>
													<td>
														<div class="visible-md visible-lg hidden-sm hidden-xs">
															<a href="editSemester.php?id=<?php echo $row['sid']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a> || 
															<a href="addSemester.php?sid=<?php echo $row['sid'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
														</div>
														<div class="visible-xs visible-sm hidden-md hidden-lg">

														</div>
													</td>
												</tr>

											<?php
												$cnt = $cnt + 1;
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
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
	</body>

	</html>
<?php } ?>