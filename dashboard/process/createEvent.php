<?php
include '../../connect.php';
define('baseURL', explode('dashboard', $_SERVER['REQUEST_URI'])[0]);
session_start();

if (isset($_POST['submit'])) {
   $title = $_POST['nama'];
   $img = $_POST['img'];
   $logo = $_POST['logo'];
   $content = $_POST['konten'];
   $start = $_POST['waktu_mulai'];
   $end = $_POST['waktu_akhir'];

   if ($_FILES['file']['name'] != '' && $title != '') {
      // Image Cek
      $image = "img" . rand(-2147483648, 2147483647) . "." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
      $logo = "logo" . rand(-2147483648, 2147483647) . "." . pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
      $target_dir = "../../img/event/";
      $logo_dir = "../../img/sertif/";
      $target_file = $target_dir . basename($_FILES["file"]["name"]);
      $logo_file = $logo_dir . basename($_FILES["logo"]["name"]);

      // Select file types
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      $logoFileType = strtolower(pathinfo($logo_file, PATHINFO_EXTENSION));

      // Valid file extensions
      $extensions_arr = array("jpg", "jpeg", "png", "gif", "webp");

      // Check image extension
      if (in_array($imageFileType, $extensions_arr)) {
         // Upload image file
         if (move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $image)) {
            // Check logo extension
            if (in_array($logoFileType, $extensions_arr)) {
               // Upload logo file
               if (move_uploaded_file($_FILES['logo']['tmp_name'], $logo_dir . $logo)) {
                  // Submit data
                  $image = baseURL . 'img/event/' . $image;
                  $logo = baseURL . 'img/sertif/' . $logo;
                  $stmt = $connect->prepare("INSERT INTO kegiatan(nama, img, logo, konten, waktu_mulai, waktu_akhir)
                     VALUES(?, ?, ?, ?, ?, ?)");

                  $stmt->bind_param("sssiis", $title, $image, $logo, $content, $start, $end);
                  $stmt->execute();

                  $_SESSION['flash_message'] = ['Successfully create event!', 'success'];
               } else {
                  $_SESSION['flash_message'] = ['Failed to upload the logo file!', 'danger'];
               }
            } else {
               $_SESSION['flash_message'] = ['Invalid logo file extension!', 'danger'];
            }
         } else {
            $_SESSION['flash_message'] = ['Failed to upload the image file!', 'danger'];
         }
      } else {
         $_SESSION['flash_message'] = ['Invalid image file extension!', 'danger'];
      }
   } else if ($title != '') {
      $stmt = $connect->prepare("INSERT INTO kegiatan(nama, konten, waktu_mulai, waktu_akhir)
         VALUES(?, ?, ?, ?)");

      $stmt->bind_param("siis", $title, $content, $start, $end);
      $stmt->execute();

      $_SESSION['flash_message'] = ['Successfully create article!', 'success'];
   }
   mysqli_close($connect);
   header('location: ../article/list.php');
}