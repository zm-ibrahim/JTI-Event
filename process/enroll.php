<?php
session_start();
require_once "../connect.php";

if (isset($_POST['kid'])) {
    $kid = $_POST['kid'];
    $user_id = $_SESSION['user_id'];

    // Check if the user is already enrolled
    $enrollmentQuery = "SELECT * FROM kegiatan_user WHERE kegiatan_id = $kid AND user_id = $user_id";
    $enrollmentResult = mysqli_query($connect, $enrollmentQuery);

    if (mysqli_num_rows($enrollmentResult) > 0) {
        // User is already enrolled
        echo 'already_enrolled';
    } else {
        // User is not enrolled, so insert the enrollment data into the table
        $insertQuery = "INSERT INTO kegiatan_user (kegiatan_id, user_id) VALUES ($kid, $user_id)";
        if (mysqli_query($connect, $insertQuery)) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    mysqli_close($connect);
}
