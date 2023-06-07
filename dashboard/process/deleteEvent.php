<?php
session_start();
include '../../connect.php';

$kid = $_GET['kid'];
$userid = $_SESSION['user_id'];

if (isset($_GET['true'])) {
    $role = $_GET['true'];
}

// Get user ID and article ID
$sql = "SELECT * FROM kegiatan WHERE id = $kid";
$result = mysqli_query($connect, $sql);
$kegiatan = mysqli_fetch_assoc($result);
$usid = $kegiatan['user_id'];
$username = $kegiatan['username'];

// Checking permission
if ((isset($_SESSION['role']) && $_SESSION['role'] == 2) || $userid == $usid) {
    // Delete related rows in kegiatan_user table
    $deleteRelatedRows = "DELETE FROM kegiatan_user WHERE kegiatan_id = $kid";
    mysqli_query($connect, $deleteRelatedRows);

    // Delete old image
    $img = $kegiatan['img'];
    if (!empty($img)) {
        $file_name = basename($img);
        unlink('../../img/kegiatan/' . $file_name);
    }

    // Delete event
    $deleteEvent = "DELETE FROM kegiatan WHERE id = $kid";
    if (mysqli_query($connect, $deleteEvent)) {
        $_SESSION['flash_message'] = ['Event deleted successfully', 'success'];
    } else {
        $_SESSION['flash_message'] = ['Failed to delete event!', 'danger'];
    }
} else {
    $_SESSION['flash_message'] = ['You don\'t have permission to delete this event!', 'danger'];
}

mysqli_close($connect);
header("Location: ../event/list.php");
exit();
