<?php
session_start();
error_reporting(0);
unset($_SESSION['msg1']);
include('include/config.php');
if (strlen($_SESSION['id'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_GET['sid'])) {
        $sid = $_GET['sid'];
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
                                                    <h5 class="panel-title">Add Course</h5>
                                                </div>
                                                <div class="panel-body">

                                                    <form role="form" name="add" method="post" action="previewCourse.php" onsubmit="return validateForm()">

                                                        <div class="form-group">
                                                            <label for="courseCode1">Course Code 1</label>
                                                            <div class="input-column">
                                                                <div class="column-small">
                                                                    <input type="text" name="pccode1" id="courseCode1" class="form-control course-code course-code-input trim-space">
                                                                </div>
                                                                <div class="column-big">
                                                                    <input type="text" id="courseName1" name="pcname1" class="form-control course-name" readonly="readonly">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group" style="display: none;" id="courseCode2Container">
                                                            <label for="courseCode2">Course Code 2</label>
                                                            <div class="input-column">
                                                                <div class="column-small">
                                                                    <input type="text" name="pccode2" id="courseCode2" class="form-control course-code course-code-input trim-space">
                                                                </div>
                                                                <div class="column-big">
                                                                    <input type="text" id="courseName2" name="pcname2" class="form-control course-name" readonly="readonly">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group" style="display: none;" id="courseCode3Container">
                                                            <label for="courseCode3">Course Code 3</label>
                                                            <div class="input-column">
                                                                <div class="column-small">
                                                                    <input type="text" name="pccode3" id="courseCode3" class="form-control course-code course-code-input trim-space">
                                                                </div>
                                                                <div class="column-big">
                                                                    <input type="text" id="courseName3" name="pcname3" class="form-control course-name" readonly="readonly">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group" style="display: none;" id="courseCode4Container">
                                                            <label for="courseCode3">Course Code 4</label>
                                                            <div class="input-column">
                                                                <div class="column-small">
                                                                    <input type="text" name="pccode4" id="courseCode4" class="form-control course-code course-code-input trim-space">
                                                                </div>
                                                                <div class="column-big">
                                                                    <input type="text" id="courseName4" name="pcname4" class="form-control course-name" readonly="readonly">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group" style="display: none;" id="courseCode5Container">
                                                            <label for="courseCode3">Course Code 5</label>
                                                            <div class="input-column">
                                                                <div class="column-small">
                                                                    <input type="text" name="pccode5" id="courseCode5" class="form-control course-code course-code-input trim-space">
                                                                </div>
                                                                <div class="column-big">
                                                                    <input type="text" id="courseName5" name="pcname5" class="form-control course-name" readonly="readonly">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group" style="display: none;" id="courseCode6Container">
                                                            <label for="courseCode3">Course Code 6</label>
                                                            <div class="input-column">
                                                                <div class="column-small">
                                                                    <input type="text" name="pccode6" id="courseCode6" class="form-control course-code course-code-input trim-space">
                                                                </div>
                                                                <div class="column-big">
                                                                    <input type="text" id="courseName6" name="pcname6" class="form-control course-name" readonly="readonly">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group" style="display: none;" id="courseCode7Container">
                                                            <label for="courseCode3">Course Code 7</label>
                                                            <div class="input-column">
                                                                <div class="column-small">
                                                                    <input type="text" name="pccode7" id="courseCode7" class="form-control course-code course-code-input trim-space">
                                                                </div>
                                                                <div class="column-big">
                                                                    <input type="text" id="courseName7" name="pcname7" class="form-control course-name" readonly="readonly">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="Extra">
                                                                For Extra credits*
                                                            </label>
                                                            <textarea type="text" name="pexCredits" id="exCredits" class="form-control" placeholder="Enter the Course Code, Name, and Reason(if applicable)."></textarea>
                                                        </div>

                                                        <input type="hidden" name="psid" value="<?php echo $sid; ?>" readonly="readonly">

                                                        <button type="submit" name="submit" class="btn btn-o btn-primary">
                                                            Submit
                                                        </button>
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
                $("form").submit(function() {
                    $(".trim-space").each(function() {
                        var trimmedValue = $.trim($(this).val());
                        $(this).val(trimmedValue);
                    });
                    return true;
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.course-code').on('input', function() {
                    var courseCode = $(this).val();
                    var courseNameInput = $(this).closest('.input-column').find('.course-name');
                    $.ajax({
                        url: 'getCourse.php',
                        type: 'POST',
                        data: {
                            courseCode: courseCode
                        },
                        success: function(response) {
                            var courseName = response.courseName;

                            courseNameInput.val(courseName);

                            if (courseNameInput.attr('id') === 'courseName1') {
                                if (courseName !== '') {
                                    $('#courseCode2Container').show();
                                }
                            } else if (courseNameInput.attr('id') === 'courseName2') {
                                if (courseName !== '') {
                                    $('#courseCode3Container').show();
                                }
                            } else if (courseNameInput.attr('id') === 'courseName3') {
                                if (courseName !== '') {
                                    $('#courseCode4Container').show();
                                }
                            } else if (courseNameInput.attr('id') === 'courseName4') {
                                if (courseName !== '') {
                                    $('#courseCode5Container').show();
                                }
                            } else if (courseNameInput.attr('id') === 'courseName5') {
                                if (courseName !== '') {
                                    $('#courseCode6Container').show();
                                }
                            } else if (courseNameInput.attr('id') === 'courseName6') {
                                if (courseName !== '') {
                                    $('#courseCode7Container').show();
                                }
                            }
                        }
                    });

                });
            });
        </script>

        <script>
            function validateForm() {
                const courseCodeInputs = document.querySelectorAll('.course-code-input');
                const enteredValues = new Set();

                for (let input of courseCodeInputs) {
                    const value = input.value.trim();

                    if (value !== '') {
                        if (enteredValues.has(value)) {
                            alert('Please enter unique course codes.');
                            return false;
                        }
                        enteredValues.add(value);
                    }
                }
                return true;
            }
        </script>

    </body>

    </html>
<?php } ?>