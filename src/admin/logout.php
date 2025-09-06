<?php
session_start();
include('include/config.php');
$_SESSION['id']=="";
date_default_timezone_set('Asia/Singapore');
$currentDateTime = date('Y-m-d H:i:s');
$ldate=date( 'd-m-Y h:i:s A', time () );
$did=$_SESSION['id'];
mysqli_query($con,"UPDATE userlog  SET logout = '$ldate' WHERE uid = '$did' ORDER BY id DESC LIMIT 1");
session_unset();
$_SESSION['errmsg']="You have successfully logout";
?>
<script language="javascript">
document.location="../index.php";
</script>
