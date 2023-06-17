<?php
include '../../connect.php';
define('baseURL', explode('dashboard', $_SERVER['REQUEST_URI'])[0]);
session_start();
$role = $_SESSION['role'];

if ($role == 2) {
    if (isset($_POST['submit'])) {
        $user = $_POST['user'];
        $kegiatan = $_POST['kegiatan'];

        $sql = "SELECT * from user WHERE id =$user";
        $articles = mysqli_query($connect, $sql);

        if (mysqli_num_rows($articles) > 0) {
            foreach ($articles as $article);
            $nama = $article['username'];
            $alamat = $article['alamat'];
            $email = $article['email'];
        }
        // Query
        $sql = "INSERT INTO penilai (kegiatan, nama, alamat, email) VALUES ('$kegiatan', '$nama', '$alamat', '$email')";
        if (mysqli_query($connect, $sql)) $_SESSION['flash_message'] = ['Penilai has been added!', 'success'];
        else $_SESSION['flash_message'] = ['Cant add penilai !', 'danger'];

        mysqli_close($connect);
        header('Location: ../penilai/list.php');
    }
}
