<?php
session_start();
error_reporting(0);
include('include/config.php');

$errorMsg = '';
$successMsg = '';

if (strlen(($_SESSION['id'] == 0))) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $sdate = $_POST['sdate'];
        $stime = $_POST['stime'];
        $edate = $_POST['edate'];
        $etime = $_POST['etime'];
        $sid = $_POST['mang'];


        date_default_timezone_set('Asia/Singapore');
        $currentDateTime = date('Y-m-d H:i:s');

        $startDateTime = DateTime::createFromFormat('Y-m-d H:i A', "$sdate $stime");
        $endDateTime = DateTime::createFromFormat('Y-m-d H:i A', "$edate $etime");

        $startDateTime->modify('-1 minute');
        $endDateTime->modify('-1 minute');

        $formattedStartDateTime = $startDateTime->format('Y-m-d H:i:s');
        $formattedEndDateTime = $endDateTime->format('Y-m-d H:i:s');
        if ($formattedStartDateTime < $currentDateTime || $formattedStartDateTime == $currentDateTime) {
            $status = 2;
        } else {
            $status = 1;
        }

        $stmt = $con->prepare("UPDATE semester SET startDate = ?, endDate = ?, status = ? WHERE sid = ?");
        $stmt->bind_param("sssi", $formattedStartDateTime, $formattedEndDateTime, $status, $sid);

        if ($stmt->execute()) {
            $successMsg = "Pre-Registration Event Has Been Successfully Created!";
        } else {
            $errorMsg = "There Was an Error!!" . $stmt->error;
        }

        $stmt->close();
    }
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

                                <div class="modal-body">
                                    <?php
                                    if (!empty($errorMsg)) {
                                        echo '<div class="alert alert-danger">' . $errorMsg . '</div>';
                                    }
                                    if (!empty($successMsg)) {
                                        echo '<div class="alert alert-success">' . $successMsg . '</div>';
                                    }
                                    ?>
                                </div>


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
                                                $panelStyle = '';
                                                if ($row['status'] == 2) {
                                                    $panelStyle = 'style="background: linear-gradient(to top, rgba(104, 255, 72, 0.30), rgba(0, 0, 0, 0));"';
                                                } elseif ($row['status'] == 1) {
                                                    $panelStyle = 'style="background: linear-gradient(to top, rgba(255, 0, 0, 0.2), rgba(0, 0, 0, 0));"';
                                                } else {
                                                    $panelStyle = 'style="background: linear-gradient(to top, rgb(160 174 157 / 43%), rgba(0, 0, 0, 0));"';
                                                }
                                                ?>
                                                <div class="panel panel-white no-radius text-center" <?php echo $panelStyle; ?>>
                                                    <div class="panel-body" style="height: 200px;">
                                                        <span class="fa-stack fa-2x">
                                                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                                                            <i class="fa fa-terminal fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                        <h2 class="StepTitle"><?php echo htmlentities($row['semesterName']); ?></h2>
                                                        <a>
                                                            <p class="links cl-effect-1">
                                                                <a href="#" data-toggle="modal" data-target="#myModal" data-sid="<?php echo $row['sid']; ?>" style="font-size: 15px;">Semester Code: <?php echo htmlentities($row['SemesterCode']); ?></a>
                                                        </a>
                                                        </P>
                                                    </div>
                                                </div>
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

                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Pre-Registration Event</h5>
                                            </div>
                                            <form method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="mang" readonly="readonly" id="modalSidInput" value="">
                                                    <table class="table table-bordered table-hover data-tables">
                                                        <tr>
                                                            <th>Start Date :</th>
                                                            <td>
                                                                <div class="form-group">
                                                                    <label for="sdate">Date</label>
                                                                    <input class="form-control datepicker" id="sdate" name="sdate" required="required" data-date-format="yyyy-mm-dd">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="stime">Time</label>
                                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                                        <input class="form-control timepicker" id="stime" name="stime" required="required" value="12:00 AM">
                                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>End Date :</th>
                                                            <td>
                                                                <div class="form-group">
                                                                    <label for="edate">Date</label>
                                                                    <input class="form-control datepicker" id="edate" name="edate" required="required" data-date-format="yyyy-mm-dd">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="etime">Time</label>
                                                                    <div class="input-group bootstrap-timepicker timepicker">
                                                                        <input class="form-control timepicker" id="etime" name="etime" required="required" value="11:59 PM">
                                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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