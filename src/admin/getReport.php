<?php
session_start();
error_reporting(0);
include('include/config.php');
if (strlen(($_SESSION['id'] == 0) || (strlen($_SESSION['login'] == 0)))) {
    header('location:logout.php');
} else {
    $sid = mysqli_real_escape_string($con, $_GET['id']);
    $sql = mysqli_query($con, "SELECT * FROM semester WHERE sid = $sid");
    $row = mysqli_fetch_array($sql);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Pre-Registration History</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            th.hide-on-print.center {
                display: none;
            }
            td.hide-on-print.center {
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
                                            $pCode = mysqli_real_escape_string($con, $_GET['pCode']);
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
                                    <div class="item-content" style="color: #3f3b3b; font-size: 20px;">
                                        <?php                                  
                                              $sql = mysqli_query($con, "SELECT COUNT(DISTINCT user.uid) AS uniqueUidCount
                                              FROM user
                                              LEFT JOIN semestercourse ON user.uid = semestercourse.uid AND semestercourse.sid = $sid
                                              WHERE user.userType = 'user' AND semestercourse.uid IS NOT NULL AND user.pCode = '$pCode'");
                                        if ($sql) {
                                            $row = mysqli_fetch_assoc($sql);
                                            $uniqueUidCount = $row['uniqueUidCount'];
                                            if (($uniqueUidCount == 1) || ($uniqueUidCount == 0)) {
                                                echo '<p style="font-family: \'themify\';"><span style="color: green; font-size: 24px;">*</span> ' . $uniqueUidCount . ' student have completed pre-registration this semester.</p>';
                                            } else {
                                                echo '<p style="font-family: \'themify\';"><span style="color: green; font-size: 24px;">*</span> ' . $uniqueUidCount . ' students have completed pre-registration this semester.</p>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <?php
                            $sql = mysqli_query($con, "SELECT DISTINCT user.*
                                FROM semester
                                LEFT JOIN semestercourse ON semester.sid = semestercourse.sid
                                LEFT JOIN user ON semestercourse.uid = user.uid
                                WHERE semestercourse.sid = '$sid' AND user.pCode = '$pCode'
                                ORDER BY user.intake ASC");
                            $currentIntake = null;
                            $cnt = 1;

                            while ($row = mysqli_fetch_array($sql)) {
                                if ($currentIntake !== $row['intake']) {
                                    if ($currentIntake !== null) {
                                        echo '</tbody></table>';
                                    }
                                    
                                    echo '<table class="table table-hover" id="sample-table-1">';
                                    echo '<thead>
                <tr>
                    <th class="center col-md-1">#</th>
                    <th class="center col-md-3">Full Name</th>
                    <th class="center col-md-2">Student ID</th>
                    <th class="center col-md-1">Intake</th>
                    <th class="center col-md-2">Contact Number</th>
                    <th class="center col-md-2">Program</th>
                    
                    <th class="hide-on-print center col-md-1">Action</th>
                </tr>
            </thead>
            <tbody>';
                                    $currentIntake = $row['intake'];
                                }
                                echo '<tr>
            <td class="center col-md-1" style="padding: 2px;">' . $cnt . '.</td>
            <td class="center col-md-3" style="padding: 2px;">' . htmlentities($row['name']) . '</td>
            <td class="center col-md-2" style="padding: 2px;">' . htmlentities($row['studentId']) . '</td>
            <td class="center col-md-1" style="padding: 2px;">' . htmlentities($row['intake']) . '</td>
            <td class="center col-md-2" style="padding: 2px;">' . htmlentities($row['contactNo']) . '</td>
            <td class="center col-md-2" style="padding: 2px;">' . htmlentities($row['pCode']) . '</td>
            <td class="center col-md-1 hide-on-print" style="padding: 2px;">
                <div class="visible-md visible-lg hidden-sm hidden-xs">
                    <a href="viewStudentSem.php?uid=' . $row['uid'] . '&sid=' . $sid . '&pCode=' . $pCode . '  " class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit"><i class="fa fa-eye"></i></a>
                </div>
            </td>
        </tr>';
                                $cnt++;
                            }
                            if ($currentIntake !== null) {
                                echo '</tbody></table>';
                            }
                            ?>


                            <br> <br> <br>

                            <div class="parent-container1">
                                <div class="item-content2">
                                    <div class="item-content" style="color: #3f3b3b; font-size: 20px;">
                                        <?php
                                        $sql = mysqli_query($con, "SELECT COUNT(DISTINCT user.uid) AS uniqueUidCount
                                FROM user
                                LEFT JOIN semestercourse ON user.uid = semestercourse.uid AND semestercourse.sid = $sid
                                WHERE user.userType = 'user' AND semestercourse.uid IS NULL AND user.pCode = '$pCode'");

                                        if ($sql) {
                                            $row = mysqli_fetch_assoc($sql);
                                            $uniqueUidCount = $row['uniqueUidCount'];

                                            if ($uniqueUidCount == 0) {
                                                echo '<p style="font-family: \'themify\';"><span style="color: green; font-size: 24px;">*</span> ' . 'All students have completed pre-registration this semester.</p>';
                                            } elseif ($uniqueUidCount == 1) {
                                                echo '<p style="font-family: \'themify\';"><span style="color: red; font-size: 24px;">*</span> ' . $uniqueUidCount . ' student have not completed pre-registration this semester.</p>';
                                            } else {
                                                echo '<p style="font-family: \'themify\';"><span style="color: red; font-size: 24px;">*</span> ' . $uniqueUidCount . ' students have not completed pre-registration this semester.</p>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <table class="table table-hover" id="sample-table-1">
                                <thead>
                                    <tr>
                                        <th class="center col-md-1">#</th>
                                        <th class="center col-md-3">Full Name</th>
                                        <th class="center col-md-2">Student ID</th>
                                        <th class="center col-md-1">Intake</th>
                                        <th class="center col-md-2">Contact Number</th>
                                        <th class="center col-md-2">Program</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                          $sql = mysqli_query($con, "SELECT DISTINCT user.*
                          FROM user
                          LEFT JOIN semestercourse ON user.uid = semestercourse.uid AND semestercourse.sid = $sid
                          WHERE user.userType = 'user' AND semestercourse.sid IS NULL AND user.pCode = '$pCode'
                          ORDER BY user.intake ASC");

                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($sql)) {
                                    ?>
                                        <tr>
                                            <td class="center col-md-1" style="padding: 2px;"><?php echo $cnt; ?>.</td>
                                            <td class="center col-md-3" style="padding: 2px;"><?php echo htmlentities($row['name']); ?></td>
                                            <td class="center col-md-2" style="padding: 2px;"><?php echo htmlentities($row['studentId']); ?></td>
                                            <td class="center col-md-1" style="padding: 2px;"><?php echo htmlentities($row['intake']); ?></td>
                                            <td class="center col-md-2" style="padding: 2px;"><?php echo htmlentities($row['contactNo']); ?></td>
                                            <td class="center col-md-2" style="padding: 2px;"><?php echo htmlentities($row['pCode']); ?></td>                                       
                                        </tr>
                                    <?php
                                        $cnt = $cnt + 1;
                                    } ?>
                                </tbody>
                            </table>
                            <?php
                            mysqli_close($con);
                            ?>
                            <br><br>
                            <div class="hide-on-print" style="margin: 10px 0 0; text-align: center;">
                                <form action="fullReport.php" method="post" style="display: inline-block;">
                                    <input type="hidden" name="sid" value="<?php echo $sid; ?>">
                                    <input type="hidden" name="pCode" value="<?php echo $pCode; ?>">
                                    <button class="btn btn-primary waves-effect waves-light w-lg" type="submit" name ="submit">Full Report</button>
                                </form>
                                <span style="margin: 0 10px;">||</span>
                                <button class="btn btn-primary waves-effect waves-light w-lg" id="printButton">Print Report</button>
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
            document.getElementById('printButton').addEventListener('click', function() {
                window.print();
            });
        </script>
    </body>

    </html>
<?php } ?>