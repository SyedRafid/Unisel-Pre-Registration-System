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
        <title>Pre-Registration History</title>

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
        <style>
            .panel-title+.row {
                border-top: 1px solid #000f;
                margin-top: 20px;
            }

            h5.panel-title {
                font-weight: bold;
            }
        </style>

        <style type="text/css" media="print">
            #printButton {
                display: none;
            }

            .hide-on-print {
                display: none;
            }
        </style>
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
                                    <h1 class="mainTitle">Student | Pre-Registration History</h1>
                                </div>
                                <div class="hide-on-print">
                                    <ol class="breadcrumb">
                                        <li>
                                            <span>Student</span>
                                        </li>
                                        <li class="active ">
                                            <span>Pre-Registration History</span>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </section>
                        <div class="container-fluid container-fullw bg-white">




                            <?php
                            $sql = mysqli_query($con, "SELECT semester.sid, semester.semesterName, course.courseName, course.courseCode, extracredit.reason
   FROM semester
   LEFT JOIN semestercourse ON semester.sid = semestercourse.sid
   LEFT JOIN course ON semestercourse.cid = course.cid
   LEFT JOIN user ON semestercourse.uid = user.uid
   LEFT JOIN extracredit ON semester.sid = extracredit.sid AND extracredit.uid = user.uid
   WHERE semestercourse.uid = '" . mysqli_real_escape_string($con, $_SESSION['id']) . "'
   ORDER BY semester.sid");

                            $currentSid = null;  
                            while ($row = mysqli_fetch_array($sql)) {
                                if ($row['sid'] !== $currentSid) {
                                    if ($currentSid !== null) {
                            ?>
                                        <tbody>
                                            <table>


                                            <?php
                                        }

                                        $currentSid = $row['sid'];
                                        $cnt = 1;
                                            ?>
                                            <h5 class="panel-title"><?php echo htmlentities($row['semesterName']); ?></h5>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php
                                                    $reason = $row['reason'];
                                                    if ($reason !== null) {                                                      
                                                    ?>
                                                        <label for="exCredits" style="margin-top:5px">Extra credits*</label>
                                                        <p id="exCredits" class="form-control autosize" style="height: auto; background-color: #8e8e930d;"><?php echo htmlentities($reason); ?></p>
                                                    <?php
                                                    }
                                                    ?>
                                                    <table class="table table-hover" id="sample-table-1">
                                                        <thead>
                                                            <tr>
                                                                <th class="center col-md-1">#</th>
                                                                <th class="center col-md-4">Course Code</th>
                                                                <th class="center col-md-9">Course Name</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                    }
                                                        ?>
                                                        <tr>
                                                            <td class="center col-md-1" style="padding: 2px;"><?php echo $cnt; ?>.</td>
                                                            <td class="center col-md-4" style="padding: 2px;"><?php echo htmlentities($row['courseCode']); ?></td>
                                                            <td class="center col-md-9" style="padding: 2px;"><?php echo htmlentities($row['courseName']); ?></td>
                                                        </tr>

                                                    <?php

                                                    $cnt++;
                                                }

                                                if ($currentSid !== null) {
                                                    ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        <?php
                                                }
                                        ?>


                                        <p align="center" style="margin: 10px 0 0;">
                                            <button class="btn btn-primary waves-effect waves-light w-lg" id="printButton">Print Report</button>
                                        </p>


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
            document.getElementById('printButton').addEventListener('click', function() {
                window.print();
            });
        </script>

    </body>

    </html>
<?php } ?>