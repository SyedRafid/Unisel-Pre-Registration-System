<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen(($_SESSION['id'] == 0) || (strlen($_SESSION['login'] == 0)))) {
    header('location:logout.php');
} else {
    if(isset($_POST['submit'])){
        $sid = mysqli_real_escape_string($con, $_POST['sid']);
        $pCode = mysqli_real_escape_string($con, $_POST['pCode']);
    }
    $sql = mysqli_query($con, "SELECT * FROM semester WHERE sid = $sid");
    $row = mysqli_fetch_array($sql);
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
            .parent-container1 {
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #8e8e930d;
            }
        </style>

        <style type="text/css" media="print">
            body {
                font-size: 12px;
            }

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
                                    <h2 class="mainTitle"><?php echo htmlentities($row['semesterName']) . '&nbsp' . '||' . '&nbsp' . 'Pre-Registration History' ?></h2>
                                </div>     
                                    <ol class="breadcrumb">
                                    <li>
                                            <?php
                                            $result = mysqli_query($con, "SELECT pName FROM program WHERE pCode='$pCode'");
                                            $count = mysqli_num_rows($result);                     
                                            if ($count > 0) {
                                                $row = mysqli_fetch_assoc($result);
                                                $pName = $row['pName'];
                                        }
                                            echo $pName;
                                            ?>
                                        </li>
                                    </ol>
                            </div>
                        </section>

                        <div class="container-fluid container-fullw bg-white">

                            <div class="parent-container1">
                                <div class="item-content2">
                                    <div class="item-content" style="color: #3f3b3b;">
                                        <div class="item-media" style="font-size: 22px;">
                                            <i class="ti-arrow-right"></i>
                                        </div>
                                        <h4 style="font-size: 18px; font-family: 'Raleway', sans-serif; font-weight: bold; color: #3f3b3b;">Name &nbsp || &nbsp Student ID &nbsp || &nbsp Intake</h4>
                                    </div>
                                </div>
                            </div>
                            <?php
                          
                          $sql = mysqli_query($con, "SELECT user.uid, user.name, user.intake, user.studentId, user.pCode, course.courseCode, course.courseName, extracredit.reason
                          FROM semester
                          LEFT JOIN semestercourse ON semester.sid = semestercourse.sid
                          LEFT JOIN course ON semestercourse.cid = course.cid
                          LEFT JOIN user ON semestercourse.uid = user.uid
                          LEFT JOIN extracredit ON semester.sid = extracredit.sid AND extracredit.uid = user.uid
                          WHERE semestercourse.sid = '$sid' AND user.pCode = '$pCode'
                          ORDER BY user.intake ASC");


                            $currentUid = null;
                            $uniqueUids = array();
                            while ($row = mysqli_fetch_array($sql)) {
                                if ($row['uid'] !== $currentUid) {
                                    if ($currentUid !== null) {
                            ?>
                                        </tbody>
                                        </table>
                                    <?php
                                    }
                                    $currentUid = $row['uid'];
                                    $cnt = 1;
                                    array_push($uniqueUids, $currentUid);
                                    ?>
                                    <div class="item-content">
                                        <div class="item-media" style="font-size: 15px;">
                                            <i class="ti-user"></i>
                                        </div>
                                        <div style="font-size: 15px; font-family: 'themify'; font-weight: bold; color: #3f3b3b;">
                                            <span class="title"><?php echo htmlentities($row['name']) . '&nbsp' . '||' . '&nbsp' . htmlentities($row['studentId']) . '&nbsp' . '||' . '&nbsp' . htmlentities($row['intake']); ?></span>
                                        </div>
                                    </div>

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

                                if ($currentUid !== null) {
                                    ?>
                                        </tbody>
                                    </table>

                                <?php
                                }
                                $totalUniqueUids = count(array_unique($uniqueUids));
                                echo '<br>';
                                if (($totalUniqueUids == 1)||($totalUniqueUids == 0)) {
                                    echo '<p class="hide-on-print" style="font-family: \'themify\';">* ' . $totalUniqueUids . ' student have completed pre-registered this semester.</p>';
                                } else {
                                    echo '<p class="hide-on-print" style="font-family: \'themify\';">* ' . $totalUniqueUids . ' students have completed pre-registered this semester.</p>';
                                }
                                ?>

                                <p align="center" style="margin: 10px 0 0;">
                                    <button class="btn btn-o btn-primary" id="printButton">Print Report</button> &nbsp &nbsp||
                                                <button type="button" onclick="history.back()" class="btn btn-o btn-primary">
                                                    Go Back
                                                </button>
                                            
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