<?php
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseCode = $_POST['courseCode'];

    $query = "SELECT `courseName` FROM `course` WHERE `courseCode` = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 's', $courseCode);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $courseName = $row['courseName'];
    } else {
        $courseName = ''; 
    }

    $response = ['courseName' => $courseName];

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request method']);
}
?>
