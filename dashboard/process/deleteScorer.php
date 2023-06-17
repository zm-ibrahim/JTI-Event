<?php
include '../../connect.php';
define('baseURL', explode('dashboard', $_SERVER['REQUEST_URI'])[0]);
session_start();
$pid = $_GET['pid'];
$role = $_SESSION['role'];

// Check Permission
if ($role == 2) {
    // Delete from penilai table
    $sql = "DELETE FROM penilai WHERE id = $pid";
    if (mysqli_query($connect, $sql)) {
        // Check if there are duplicate emails
        $checkDuplicatesQuery = "SELECT email, COUNT(*) AS count FROM penilai GROUP BY email HAVING count > 1";
        $checkDuplicatesResult = mysqli_query($connect, $checkDuplicatesQuery);

        if (mysqli_num_rows($checkDuplicatesResult) == 0) {
            // Update role to 0 in user table for matching names
            $updateRoleQuery = "UPDATE user SET role = 0 WHERE username IN (SELECT p.nama FROM penilai p LEFT JOIN user u ON p.nama = u.username WHERE u.username IS NOT NULL)";
            mysqli_query($connect, $updateRoleQuery);

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
