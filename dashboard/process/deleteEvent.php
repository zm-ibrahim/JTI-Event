<?php
include '../../connect.php';
define('baseURL', explode('dashboard', $_SERVER['REQUEST_URI'])[0]);
session_start();
$kid = $_GET['kid'];
$userid = $_SESSION['user_id'];

if (isset($_GET['true'])) {
    $role = $_GET['true'];
}

// Get userid and article id
$sql = "SELECT * from kegiatan WHERE id=$kid";
$call = (mysqli_query($connect, $sql));
$user = mysqli_fetch_assoc($call);
$usid = $user['user_id'];
$username = $user['username'];

// Checking Permission
if ((isset($role) && $role == 2)) {
    // delete old image
    $sql = "SELECT img FROM kegiatan WHERE id=$kid";
    $file = mysqli_query($connect, $sql);
    $file = $file->fetch_assoc();

    if ($file['img'] != '') {
        $file_name = basename($file['img'], '?' . $_SERVER['QUERY_STRING']);
        unlink('../../img/kegiatan/' . $file_name);
    }

    $sql = "SELECT logo FROM kegiatan WHERE id=$kid";
    $file = mysqli_query($connect, $sql);
    $file = $file->fetch_assoc();
    if ($file['logo'] != '') {
        $file_name = basename($file['img'], '?' . $_SERVER['QUERY_STRING']);
        unlink('../../img/sertif/' . $file_name);
    }

    //delete event
    $sql = "DELETE FROM kegiatan WHERE id=$kid";
    if (mysqli_query($connect, $sql)) $_SESSION['flash_message'] = ['Event deleted succesfully', 'success'];
    else $_SESSION['flash_message'] = ['Cant delete event!', 'danger'];

    //delete event from saved
    $sql = "DELETE FROM kegiatanuser WHERE kegiatan=$kid";
    if (mysqli_query($connect, $sql)) $_SESSION['flash_message'] = ['Event deleted succesfully', 'success'];
    else $_SESSION['flash_message'] = ['Cant delete event!', 'danger'];
} else $_SESSION['flase_message'] = ['You dont have permission to delete this event!', 'danger'];

mysqli_close($connect);
if ($role == 2) header("Location: ../event/list.php");
else header("Location: ../event/list.php");
