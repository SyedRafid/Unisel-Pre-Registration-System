<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $sid = $_POST['sid'];
        $icno = $_POST['icno'];
        $intake = $_POST['intake'];
        $contactno = $_POST['contactno'];

        $sql = mysqli_query($con, "Update user set name='$name', studentId='$sid', icno='$icno', intake='$intake', contactNo='$contactno' where uid='" . $_SESSION['id'] . "'");
        if ($sql) {
            $msg = "Admin Details updated Successfully";
        } else {
            echo "<script>alert('Error updating Profile');</script>";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Edit Profile</title>
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
                                    <h1 class="mainTitle">Admin | Edit Profile</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li>
                                        <span>Admin </span>
                                    </li>
                                    <li class="active">
                                        <span>Edit Profile</span>
                                    </li>
                                </ol>
                            </div>
                        </section>
                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 style="color: green; font-size:18px; ">
                                        <?php if ($msg) {
                                            echo htmlentities($msg);
                                        } ?> </h5>
                                    <div class="row margin-top-30">
                                        <div class="col-lg-8 col-md-12">
                                            <div class="panel panel-white">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">Edit Profile</h5>
                                                </div>
                                                <div class="panel-body">
                                                    <?php
                                                    $sql = mysqli_query($con, "select * from user where user.uid='" . $_SESSION['id'] . "'");
                                                    while ($data = mysqli_fetch_array($sql)) {
                                                    ?>
                                                        <h4><?php echo htmlentities($data['name']); ?>'s Profile</h4>
                                                        <p><b>Profile Reg. Date:
                                                            </b><?php echo htmlentities($data['CreationDate']); ?></p>
                                                        <hr />
                                                        <form role="form" name="edit" method="post">
                                                            <div class="form-group">
                                                                <label for="name">
                                                                    Name
                                                                </label>
                                                                <input type="text" name="name" class="form-control" value="<?php echo htmlentities($data['name']); ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="StudentID ">
                                                                    Student ID / Stuff ID
                                                                </label>
                                                                <input type="text" name="sid" class="form-control" value="<?php echo htmlentities($data['studentId']); ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="ICNO">
                                                                    IC NO / Passport
                                                                </label>
                                                                <input type="text" name="icno" class="form-control" required="required" value="<?php echo htmlentities($data['icno']); ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Intake">
                                                                    Intake
                                                                </label>
                                                                <input type="text" name="intake" class="form-control" required="required" value="<?php echo htmlentities($data['intake']); ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for=" contactno">
                                                                    Contact no
                                                                </label>
                                                                <input type="text" name="contactno" class="form-control" required="required" value="<?php echo htmlentities($data['contactNo']); ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Email">
                                                                    Admin Email
                                                                </label>
                                                                <input type="email" name="email" class="form-control" readonly="readonly" value="<?php echo htmlentities($data['email']); ?>">
                                                                <a href="change-emaild.php">Update your email ID</a>
                                                            </div>
                                                            <button type="submit" name="submit" class="btn btn-o btn-primary">
                                                                Update
                                                            </button>
                                                        </form>
                                                    <?php } ?>
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
        </script>>
    </body>

    </html>
<?php } ?>