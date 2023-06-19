<?php
include '../../connect.php';
define('baseURL', explode('dashboard', $_SERVER['REQUEST_URI'])[0]);
session_start();
$pid = $_GET['pid'];
$role = $_SESSION['role'];

// Check Permission
if ($role == 2) {
    // Delete from penilai table
    $sql = "UPDATE user SET role = 0 WHERE username IN (SELECT p.nama FROM penilai p LEFT JOIN user u ON p.nama = u.username WHERE u.username IS NOT NULL)";
    if (mysqli_query($connect, $sql)) {
        $sql = "DELETE FROM penilai WHERE id = $pid";
        if (mysqli_query($connect, $sql)) {
            $_SESSION['flash_message'] = ['Penilai deleted successfully! Role assigned to user !', 'success'];
        } else {
            $_SESSION['flash_message'] = ['Penilai deleted successfully, but there are still duplicate emails in the penilai table.', 'warning'];
        }
    } else {
        $_SESSION['flash_message'] = ['Cant delete penilai', 'danger'];
    }

    mysqli_close($connect);
    header('Location: ../penilai/list.php');
}
