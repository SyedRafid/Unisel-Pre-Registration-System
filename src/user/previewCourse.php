<?php
session_start();
error_reporting(0);
unset($_SESSION['msg1']);
include('include/config.php');
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $pccode1 = isset($_POST['pccode1']) ? strtoupper($_POST['pccode1']) : '';
        $pccode2 = isset($_POST['pccode2']) ? strtoupper($_POST['pccode2']) : '';
        $pccode3 = isset($_POST['pccode3']) ? strtoupper($_POST['pccode3']) : '';
        $pccode4 = isset($_POST['pccode4']) ? strtoupper($_POST['pccode4']) : '';
        $pccode5 = isset($_POST['pccode5']) ? strtoupper($_POST['pccode5']) : '';
        $pccode6 = isset($_POST['pccode6']) ? strtoupper($_POST['pccode6']) : '';
        $pccode7 = isset($_POST['pccode7']) ? strtoupper($_POST['pccode7']) : '';
        $pcname1 = $_POST['pcname1'];
        $pcname2 = $_POST['pcname2'];
        $pcname3 = $_POST['pcname3'];
        $pcname4 = $_POST['pcname4'];
        $pcname5 = $_POST['pcname5'];
        $pcname6 = $_POST['pcname6'];
        $pcname7 = $_POST['pcname7'];
        $pexCredits = $_POST['pexCredits'];
        $psid = $_POST['psid'];
    }

    if (isset($_POST['submit2'])) {
        $ccode1 = $_POST['ccode1'];
        $ccode2 = $_POST['ccode2'];
        $ccode3 = $_POST['ccode3'];
        $ccode4 = $_POST['ccode4'];
        $ccode5 = $_POST['ccode5'];
        $ccode6 = $_POST['ccode6'];
        $ccode7 = $_POST['ccode7'];
        $exCredits = $_POST['exCredits'];

        $sid = $_POST['sid'];
        $uid = $_SESSION['id'];

        $totalSum = 0;
        foreach ([$ccode1, $ccode2, $ccode3, $ccode4, $ccode5, $ccode6, $ccode7] as $code) {
            $lastDigit = intval(substr($code, -1));
            $totalSum += $lastDigit;
        }

        $sql = mysqli_query($con, "SELECT SemesterCode FROM semester WHERE sid = '$sid'");
        $data = mysqli_fetch_array($sql);

        $sCode = $data['SemesterCode'];

        $fsCode = substr((string)$sCode, 0, 1);
        $courseCodes = array($ccode1, $ccode2, $ccode3, $ccode4, $ccode5, $ccode6, $ccode7);
        $courseCodesString = "'" . implode("','", $courseCodes) . "'";
        $sql = "SELECT `cid` FROM `course` WHERE `courseCode` IN ($courseCodesString)";
        $result = mysqli_query($con, $sql);

        if ($result) {
            $cidArray = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $cidArray[] = $row['cid'];
            }
        }

        if ((($fsCode == '1') || ($fsCode == '3')) && ($totalSum > 11 && $totalSum < 19)) {
            $sql = "INSERT INTO `semestercourse` (`uid`, `sid`, `cid`) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);

            if ($stmt) {
                $success = true;

                foreach ($cidArray as $cid) {
                    mysqli_stmt_bind_param($stmt, "iis", $uid, $sid, $cid);

                    if (!mysqli_stmt_execute($stmt)) {
                        $_SESSION['msg1'] = 'Something went wrong. Please try again..!! ' . mysqli_error($con);
                        $success = false;
                        break;
                    }
                }
                mysqli_stmt_close($stmt);

                if ($success) {
                    if (!empty($exCredits)) {
                        $sql = "INSERT INTO `extracredit` (`uid`, `sid`, `reason`) VALUES (?, ?, ?)";
                        $stmt = mysqli_prepare($con, $sql);

                        if ($stmt) {
                            mysqli_stmt_bind_param($stmt, "iis", $uid, $sid, $exCredits);

                            if (mysqli_stmt_execute($stmt)) {
                                echo "<script>alert('You have completed the pre-registration');</script>";
                                echo "<script>window.location.href='dashboard.php';</script>";
                            } else {
                                $_SESSION['msg2'] = 'Something went wrong. Please try again..!! ' . mysqli_error($con);
                            }

                            mysqli_stmt_close($stmt);
                        } else {
                            $_SESSION['msg2'] = 'Something went wrong. Please try again..!! ' . mysqli_error($con);
                        }
                    } else {
                        echo "<script>alert('You have completed the pre-registration');</script>";
                        echo "<script>window.location.href='dashboard.php';</script>";
                    }
                }
            } else {
                $_SESSION['msg1'] = 'Something went wrong. Please try again..!! ' . mysqli_error($con);
            }
        } else if (($fsCode == '2') && ($totalSum > 5 && $totalSum < 10)) {
            $sql = "INSERT INTO `semestercourse` (`uid`, `sid`, `cid`) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);

            if ($stmt) {
                $success = true;

                foreach ($cidArray as $cid) {
                    mysqli_stmt_bind_param($stmt, "iis", $uid, $sid, $cid);

                    if (!mysqli_stmt_execute($stmt)) {
                        $_SESSION['msg1'] = 'Something went wrong. Please try again..!! ' . mysqli_error($con);
                        $success = false;
                        break;
                    }
                }
                mysqli_stmt_close($stmt);

                if ($success) {
                    if (!empty($exCredits)) {
                        $sql = "INSERT INTO `extracredit` (`uid`, `sid`, `reason`) VALUES (?, ?, ?)";
                        $stmt = mysqli_prepare($con, $sql);

                        if ($stmt) {
                            mysqli_stmt_bind_param($stmt, "iis", $uid, $sid, $exCredits);

                            if (mysqli_stmt_execute($stmt)) {
                                echo "<script>alert('You have completed the pre-registration');</script>";
                                echo "<script>window.location.href='dashboard.php';</script>";
                            } else {
                                $_SESSION['msg1'] = 'Something went wrong. Please try again..!! ' . mysqli_error($con);
                            }

                            mysqli_stmt_close($stmt);
                        } else {
                            $_SESSION['msg1'] = 'Something went wrong. Please try again..!! ' . mysqli_error($con);
                        }
                    } else {
                        echo "<script>alert('You have completed the pre-registration');</script>";
                        echo "<script>window.location.href='dashboard.php';</script>";
                    }
                }
            } else {
                $_SESSION['msg1'] = 'Something went wrong. Please try again..!! ' . mysqli_error($con);
            }
        } else if ((($fsCode == '1') || ($fsCode == '3')) && ($totalSum <= 11)) {
            echo "<script>alert('You must take at least 12 credits.');</script>";
            echo "<script>window.location.href='addCourse.php?sid=$sid';</script>";
        } else if ((($fsCode == '1') || ($fsCode == '3')) && ($totalSum >= 19)) {
            echo "<script>alert('You cannot take more than 18 credits.');</script>";
            echo "<script>window.location.href='addCourse.php?sid=$sid';</script>";
        } else if (($fsCode == '2') && ($totalSum <= 5)) {
            echo "<script>alert('You must take at least 6 credits.');</script>";
            echo "<script>window.location.href='addCourse.php?sid=$sid';</script>";
        } else if (($fsCode == '2') && ($totalSum >= 10)) {
            echo "<script>alert('You cannot take more than 9 credits.');</script>";
            echo "<script>window.location.href='addCourse.php?sid=$sid';</script>";
        }
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Pre-Registration</title>

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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <style>
            .input-column {
                display: flex;
            }

            .column-small {
                flex: 1;

            }

            .column-big {
                flex: 2;

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
                                    <h1 class="mainTitle">Student | Pre-Registration</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li>
                                        <span>Student</span>
                                    </li>
                                    <li class="active">
                                        <span>Pre-Registration</span>
                                    </li>
                                </ol>
                        </section>
                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="row margin-top-30">
                                        <div class="col-lg-8 col-md-12">
                                            <div class="panel panel-white">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title"> Confirm Pre-Registration </h5>
                                                </div>
                                                <div class="panel-body">
                                                    <p style="color:red;"><?php echo htmlentities($_SESSION['msg1']); ?>
                                                        <?php echo htmlentities($_SESSION['msg1'] = ""); ?></p>
                                                    <p style="color:green;"><?php echo htmlentities($_SESSION['msg2']); ?>
                                                        <?php echo htmlentities($_SESSION['msg2'] = ""); ?></p>

                                                    <form role="form" name="add" method="post" onsubmit="return validateForm()">

                                                        <div class="form-group">
                                                            <label for="courseCode1">Course Code 1</label>
                                                            <div class="input-column">
                                                                <div class="column-small">
                                                                    <input type="text" name="ccode1" id="courseCode1" class="form-control course-code course-code-input trim-space" value="<?php echo $pccode1 ?>" readonly="readonly">
                                                                </div>
                                                                <div class="column-big">
                                                                    <input type="text" id="courseName1" class="form-control course-name" value="<?php echo $pcname1 ?>" readonly="readonly">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group" id="courseCode2Container">
                                                            <label for="courseCode2">Course Code 2</label>
                                                            <div class="input-column">
                                                                <div class="column-small">
                                                                    <input type="text" name="ccode2" id="courseCode2" class="form-control course-code course-code-input trim-space" value="<?php echo $pccode2 ?>" readonly="readonly">
                                                                </div>
                                                                <div class="column-big">
                                                                    <input type="text" id="courseName2" class="form-control course-name" value="<?php echo $pcname2 ?>" readonly="readonly">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group"  id="courseCode3Container">
                                                            <label for="courseCode3">Course Code 3</label>
                                                            <div class="input-column">
                                                                <div class="column-small">
                                                                    <input type="text" name="ccode3" id="courseCode3" class="form-control course-code course-code-input trim-space" value="<?php echo $pccode3 ?>" readonly="readonly">
                                                                </div>
                                                                <div class="column-big">
                                                                    <input type="text" id="courseName3" class="form-control course-name" value="<?php echo $pcname3 ?>" readonly="readonly">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group" id="courseCode4Container">
                                                            <label for="courseCode3">Course Code 4</label>
                                                            <div class="input-column">
                                                                <div class="column-small">
                                                                    <input type="text" name="ccode4" id="courseCode4" class="form-control course-code course-code-input trim-space" value="<?php echo $pccode4 ?>" readonly="readonly">
                                                                </div>
                                                                <div class="column-big">
                                                                    <input type="text" id="courseName4" class="form-control course-name" value="<?php echo $pcname4 ?>" readonly="readonly">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group" id="courseCode5Container">
                                                            <label for="courseCode5">Course Code 5</label>
                                                            <div class="input-column">
                                                                <div class="column-small">
                                                                    <input type="text" name="ccode5" id="courseCode5" class="form-control course-code course-code-input trim-space" value="<?php echo $pccode5 ?>" readonly="readonly">
                                                                </div>
                                                                <div class="column-big">
                                                                    <input type="text" id="courseName5" class="form-control course-name" value="<?php echo $pcname5 ?>" readonly="readonly">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group" id="courseCode6Container">
                                                            <label for="courseCode3">Course Code 6</label>
                                                            <div class="input-column">
                                                                <div class="column-small">
                                                                    <input type="text" name="ccode6" id="courseCode6" class="form-control course-code course-code-input trim-space" value="<?php echo $pccode6 ?>" readonly="readonly">
                                                                </div>
                                                                <div class="column-big">
                                                                    <input type="text" id="courseName6" class="form-control course-name" value="<?php echo $pcname6 ?>" readonly="readonly">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group" id="courseCode7Container">
                                                            <label for="courseCode7">Course Code 7</label>
                                                            <div class="input-column">
                                                                <div class="column-small">
                                                                    <input type="text" name="ccode7" id="courseCode7" class="form-control course-code course-code-input trim-space" value="<?php echo $pccode7 ?>" readonly="readonly">
                                                                </div>
                                                                <div class="column-big">
                                                                    <input type="text" id="courseName7" class="form-control course-name" value="<?php echo $pcname7 ?>" readonly="readonly">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="Extra">
                                                                For Extra credits*
                                                            </label>
                                                            <textarea name="exCredits" id="exCredits" class="form-control" readonly="readonly" placeholder="Enter the Course Code, Name, and Reason(if applicable)."><?php echo $pexCredits ?></textarea>
                                                        </div>

                                                        <input type="hidden" name="sid" value="<?php echo $psid; ?>" readonly="readonly">

                                                        <div style="text-align: center;">
                                                            <button type="button" onclick="history.back()" class="btn btn-o btn-primary">
                                                                Go Back
                                                            </button> &nbsp&nbsp&nbsp||<button type="submit" name="submit2" class="btn btn-o btn-primary">
                                                                Confirm
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
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

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                startDate: '-3d'
            });
        </script>

        <script type="text/javascript">
            $('#timepicker1').timepicker();
        </script>

<script>
    $(document).ready(function() {
        $("form[name='add']").submit(function() {
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