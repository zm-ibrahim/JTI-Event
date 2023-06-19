<?php
include '../../connect.php';
define('baseURL', explode('dashboard', $_SERVER['REQUEST_URI'])[0]);
session_start();
$role = $_SESSION['role'];

if ($role == 1) {
    if (isset($_POST['submit'])) {
        $keguid = $_POST['user'];
        $kegid = $_POST['kegiatan'];
        $pid = $_POST['penilai'];
        $skor = $_POST['skor'];

        // Query
        $sql = "INSERT INTO skor (kegiatan, user, penilai, skor) VALUES ('$kegid','$keguid','$pid','$skor')";
        try {
            mysqli_query($connect, $sql);
            $_SESSION['flash_message'] = ['Score has been added!', 'success'];
        } catch (\Throwable $th) {
            $_SESSION['flash_message'] = ['Cant add Score!', 'danger'];
        }

        mysqli_close($connect);
        header('Location: ../scores/list.php');
    }
}
