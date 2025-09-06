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
        $ccode = $_POST['ccode'];
        $cname = $_POST['cname'];
        $result = mysqli_query($con, "(SELECT courseCode FROM course WHERE courseCode='$ccode')");
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            $_SESSION['msgs'] = "course code already exists!!";
        } else {
            $sql = mysqli_query($con, "insert into course(courseCode, courseName) values('$ccode', '$cname')");

            if ($sql) {
                $_SESSION['msg'] = "Course added successfully !!";
            } else {
                $_SESSION['msgs'] = "Failed to add course Please try again.";
            }
        }
    }

	if (isset($_GET['del'])) {
		$cid = $_GET['id'];
		$result = mysqli_query($con, "delete from course where cid = '$cid'");
	
		if ($result) {
			echo '<script>
				if(confirm("Course data deleted successfully! Press OK to continue.")){
					window.location = "addCourse.php";
				}
			</script>';
		} else {
			echo '<script>
				if(confirm("Failed to delete course data. Please try again. Press OK to continue.")){
					window.location = "addCourse.php";
				}
			</script>';
		}
	}
	
?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Manage Course</title>

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
									<h1 class="mainTitle">Admin | Manage Course</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Manage Course</span>
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
													<h5 class="panel-title">Add Course</h5>
												</div>
												<div class="panel-body">
													<p style="color:green;"><?php echo htmlentities($_SESSION['msg']); ?></p>
													<p style="color:red;"><?php echo htmlentities($_SESSION['msgs']); ?></p>
													<form role="form" name="dcotorspcl" method="post">
														<div class="form-row">
															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputEmail1">Enter Course Code</label>
																	<input type="text" name="ccode" class="form-control" placeholder="Course Code" required>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputEmail1">Enter Course Name</label>
																	<input type="text" name="cname" class="form-control" placeholder="Course Name" required>
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
									<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Course List</span></h5>

									<table class="table table-hover" id="sample-table-1">
										<thead>
											<tr>
												<th class="center">#</th>
												<th>Course code</th>
												<th>Course Name</th>
												<th>Creation Date</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sql = mysqli_query($con, "select * from course ORDER BY `course`.`courseCode` ASC ");
											$cnt = 1;
											while ($row = mysqli_fetch_array($sql)) {
											?>
												<tr>
													<td class="center"><?php echo $cnt; ?>.</td>
													<td><?php echo $row['courseCode']; ?></td>
													<td><?php echo $row['courseName']; ?></td>
													<td><?php echo $row['CreationDate']; ?>
													</td>
													<td>
														<div class="visible-md visible-lg hidden-sm hidden-xs">
															<a href="editCourse.php?id=<?php echo $row['cid']; ?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-pencil"></i></a> || 
															<a href="addCourse.php?id=<?php echo $row['cid'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
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