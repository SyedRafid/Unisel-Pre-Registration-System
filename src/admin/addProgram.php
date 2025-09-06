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
        $pCode = isset($_POST['pCode']) ? strtoupper($_POST['pCode']) : '';
        $pName = isset($_POST['pName']) ? strtoupper($_POST['pName']) : '';
        $result = mysqli_query($con, "SELECT pCode FROM program WHERE pCode='$pCode'");
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            $_SESSION['msgs'] = "Program code already exists!!";
        } else {
            $sql = mysqli_query($con, "INSERT INTO program(pCode, pName) VALUES('$pCode', '$pName')");
    
            if ($sql) {
                $_SESSION['msg'] = "Program added successfully !!";
            } else {
                $_SESSION['msgs'] = "Failed to add Program. Please try again.";
            }
        }
    }
    

	if (isset($_GET['del'])) {
		$pCode = $_GET['id'];
		$result = mysqli_query($con, "delete from Program where pCode = '$pCode'");
	
		if ($result) {
			echo '<script>
				if(confirm("Program data deleted successfully! Press OK to continue.")){
					window.location = "addProgram.php";
				}
			</script>';
		} else {
			echo '<script>
				if(confirm("Failed to delete Program data. Please try again. Press OK to continue.")){
					window.location = "addProgram.php";
				}
			</script>';
		}
	}
	
?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Manage Program</title>

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
									<h1 class="mainTitle">Admin | Manage Program</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Manage Program</span>
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
													<h5 class="panel-title">Add Program</h5>
												</div>
												<div class="panel-body">
													<p style="color:green;"><?php echo htmlentities($_SESSION['msg']); ?></p>
													<p style="color:red;"><?php echo htmlentities($_SESSION['msgs']); ?></p>
													<form role="form" name="dcotorspcl" method="post">
                                                    <div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputEmail1">Enter Program Name</label>
																	<input type="text" name="pName" class="form-control" placeholder="Program Name" required>
																</div>
															</div>
														<div class="form-row">
															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputEmail1">Enter Program Code</label>
																	<input type="text" name="pCode" class="form-control" placeholder="Program Code" required>
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
									<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Program List</span></h5>

									<table class="table table-hover" id="sample-table-1">
                                        <thead>
                                            <tr>
                                                <th class="center col-md-1">#</th>
                                                <th class="center col-md-6">Program Name</th>
                                                <th class="center col-md-3">Program Code</th>
                                                <th class="center col-md-1">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = mysqli_query($con, "select * from program  ORDER BY program.pCode ASC");
                                            $cnt = 1;
                                            while ($row = mysqli_fetch_array($sql)) {
                                            ?>
                                                <tr>
                                                    <td class="center col-md-1"><?php echo $cnt; ?>.</td>
                                                    <td class="center col-md-6"><?php echo $row['pName']; ?></td>
                                                    <td class="center col-md-3"><?php echo $row['pCode']; ?></td>
                                                    <td class="center col-md-1>
                                                        <div class="visible-md visible-lg hidden-sm hidden-xs">
                                                            <a href="addProgram.php?id=<?php echo $row['pCode'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><i class="fa fa-times fa fa-white"></i></a>
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