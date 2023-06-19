<?php
include '../../connect.php';
define('baseURL', explode('dashboard', $_SERVER['REQUEST_URI'])[0]);
session_start();
$role = $_SESSION['role'];

// Check Permission
if ($role == 1 && isset($_POST['submit'])) {
    $idskor = $_POST['idskor'];
    $skor = $_POST['skor'];

    // Query
    $sql = "UPDATE skor SET skor='$skor' WHERE id='$idskor'";

    try {
        mysqli_query($connect, $sql);
        $_SESSION['flash_message'] = ['Score has been updated!', 'success'];
    } catch (\Throwable $th) {
        $_SESSION['flash_message'] = ['Cant update Score!', 'danger'];
    }

    mysqli_close($connect);
    header('Location: ../scores/list.php');
}
