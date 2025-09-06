<?php
session_start();
include("include/config.php");

if (isset($_POST['change'])) {
    if (valid()) {
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $icno = $_SESSION['icno'];
        $newpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $query = mysqli_query($con, "UPDATE user SET password='$newpassword' WHERE name='$name' AND email='$email' AND icno='$icno'");

        if ($query) {
            echo "<script>alert('Password successfully updated.');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Failed to update password.');</script>";
        }
    }
}
function valid() {
    if (empty($_POST['password'])) {
        echo "<script>alert('New Password Field is Empty !!');</script>";
        return false;
    } elseif (empty($_POST['password_again'])) {
        echo "<script>alert('Confirm Password Field is Empty !!');</script>";
        return false;
    } elseif ($_POST['password'] !== $_POST['password_again']) {
        echo "<script>alert('Password and Confirm Password Field do not match !!');</script>";
        return false;
    }
    return true;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Password Recovery</title>

    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
    <link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
    <link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
    <link rel="icon" href="assets/images/icon1.jpg">
    <style>
        body {
            background: url(assets/images/unisel.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>

<body class="login">
    <div class="row">
        <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="box-login">
                <div class="logo margin-top-30">
                    <a href="index.php">
                        <h2> UPRS | Password Recovery</h2>
                    </a>
                </div>
                <form class="form-login" name="passwordreset" method="post" onSubmit="return valid();">
                    <fieldset>
                        <legend>
                            User Reset Password
                        </legend>
                        <p>
                            Please set your new password.<br />
                        </p>

                        <div class="form-group">
                            <span class="input-icon">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <i class="fa fa-lock"></i> </span>
                        </div>


                        <div class="form-group">
                            <span class="input-icon">
                                <input type="password" class="form-control" id="password_again" name="password_again" placeholder="Confirm Password">
                                <i class="fa fa-lock"></i> </span>
                        </div>


                        <div class="form-actions">

                            <button type="submit" class="btn btn-primary pull-right" name="change">
                                Change <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                        <div class="new-account">
                            Already have an account?
                            <a href="login.php">
                                Log-in
                            </a>
                        </div>
                    </fieldset>
                </form>

                <div class="copyright">
                    &copy; <span class="text-bold text-uppercase">Unisel Pre-Registration System</span>
                </div>

            </div>

        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/switchery/switchery.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>

    <script src="assets/js/main.js"></script>

    <script src="assets/js/login.js"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            Login.init();
        });
    </script>
</body>


</html>