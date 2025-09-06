<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_prs";
$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

date_default_timezone_set('Asia/Singapore');
$currentDateTime = date('Y-m-d H:i:s');


$sql = "UPDATE semester
        SET status = 2
        WHERE '$currentDateTime' BETWEEN startDate AND endDate";

if ($con->query($sql)) {
    echo "Status updated to 2 successfully";
    var_dump($con->affected_rows);
    var_dump($con->insert_id);
} else {
    echo "Error updating status to 2: " . $con->error;
}

$sql = "UPDATE semester
        SET status = 0
        WHERE endDate < '$currentDateTime'";

if ($con->query($sql)) {
    echo "Status updated to 0 successfully";
} else {
    echo "Error updating status to 0: " . $con->error;
}
$con->close();
?>
