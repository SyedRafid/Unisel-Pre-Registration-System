<?php
session_start();
error_reporting(0);
include('include/config.php');

$errorMsg = '';
$successMsg = '';

if (strlen(($_SESSION['id'] == 0))) {
    header('location:logout.php');
} else {
    $sid = mysqli_real_escape_string($con, $_GET['sid']);
    $sql = mysqli_query($con, "SELECT * FROM semester WHERE sid = $sid");
    $row = mysqli_fetch_array($sql);



?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Pre-Registration Event</title>

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
        <link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.3.5/jquery.timepicker.min.css">
        <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.3.5/jquery.timepicker.min.js"></script>
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
                                    <h2 class="mainTitle"><?php echo htmlentities($row['semesterName']) . '&nbsp' . '||' . '&nbsp' . 'Pre-Registration History' ?></h2>
                                </div>
                                <ol class="breadcrumb">
                                    <li>
                                        <span>Admin</span>
                                    </li>
                                    <li class="active">
                                        <span>Pre-Registration Event</span>
                                    </li>
                                </ol>
                            </div>
                        </section>
                        <div class="container-fluid container-fullw bg-white">


                            <div class="row">
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
                                                    <td class="center col-md-1">
                                                        <div class="visible-md visible-lg hidden-sm hidden-xs">
                                                            <a href="getReport.php?pCode=<?php echo $row['pCode']; ?>&id=<?php echo $sid;?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-eye fa fa-white"></i></a>
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
            $(document).ready(function() {
                $('a[data-target="#myModal"]').on('click', function(event) {
                    var sid = $(this).data('sid');
                    $('#modalSidInput').val(sid);
                });

                $('#myModal').on('show.bs.modal', function(event) {
                    var sid = $('#modalSidInput').val();
                });
            });
            jQuery(document).ready(function() {
                Main.init();
                FormElements.init();
            });
        </script>

    </body>

    </html>
<?php } ?>