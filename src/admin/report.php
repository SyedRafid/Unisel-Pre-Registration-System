<?php
session_start();
error_reporting(0);
include('include/config.php');

$errorMsg = '';
$successMsg = '';

if (strlen(($_SESSION['id'] == 0))) {
    header('location:logout.php');
} else {


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
                                    <h1 class="mainTitle">Admin | Pre-Registration Event</h1>
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
                                <div class="container">
                                    <?php
                                    $sql = "SELECT `sid`, `SemesterCode`, `semesterName`, `status` FROM `semester`";
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
                                                <?php
                                                $pCode = $_GET['pCode'];
                                                ?>
                                                <a href="getProgram.php?sid=<?php echo $row['sid']; ?>">
                                                <div class=" panel panel-white no-radius text-center" style="background: linear-gradient(to top, rgb(160 174 157 / 43%), rgba(0, 0, 0, 0));">
                                                    <div class="panel-body" style="height: 200px;">
                                                        <span class="fa-stack fa-2x">
                                                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                                                            <i class="fa fa-terminal fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                        <h2 class="StepTitle"><?php echo htmlentities($row['semesterName']); ?></h2>
                                                    </div>
                                            </div>
                                            </a>
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