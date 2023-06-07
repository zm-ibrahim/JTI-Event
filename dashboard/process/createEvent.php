<?php
include '../../connect.php';
define('baseURL', explode('dashboard', $_SERVER['REQUEST_URI'])[0]);
session_start();

if (isset($_POST['submit'])) {
   $title = $_POST['name'];
   $content = $_POST['konten'];
   $start_date = $_POST['tanggal-mulai'];
   $start_time = $_POST['waktu-mulai'];
   $end_date = $_POST['tanggal-akhir'];
   $end_time = $_POST['waktu-akhir'];

   // Combine date and time values into datetime strings
   $start_datetime = date('Y-m-d H:i:s', strtotime("$start_date $start_time"));
   $end_datetime = date('Y-m-d H:i:s', strtotime("$end_date $end_time"));

   if ($_FILES['file']['name'] != '' && $title != '') {
      // Image Check
      $image = "img" . rand(-2147483648, 2147483647) . "." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
      $target_dir = "../../img/event/";
      $target_file = $target_dir . $image;

      // Valid file extensions
      $extensions_arr = array("jpg", "jpeg", "png", "gif", "webp");

      // Check image extension
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      if (in_array($imageFileType, $extensions_arr)) {
         // Upload image file
         if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            $image = baseURL . 'img/event/' . $image;

            // Logo Check
            if ($_FILES['logo']['name'] != '') {
               $logo = "logo" . rand(-2147483648, 2147483647) . "." . pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
               $logo_dir = "../../img/sertif/";
               $logo_file = $logo_dir . $logo;

               // Check logo extension
               $logoFileType = strtolower(pathinfo($logo_file, PATHINFO_EXTENSION));
               if (in_array($logoFileType, $extensions_arr)) {
                  // Upload logo file
                  if (move_uploaded_file($_FILES['logo']['tmp_name'], $logo_file)) {
                     $logo = baseURL . 'img/sertif/' . $logo;

                     // Submit data
                     $stmt = $connect->prepare("INSERT INTO kegiatan(nama, img, logo, konten, waktu_mulai, waktu_akhir)
                        VALUES(?, ?, ?, ?, ?, ?)");

                     $stmt->bind_param("ssssss", $title, $image, $logo, $content, $start_datetime, $end_datetime);
                     $stmt->execute();

                     $_SESSION['flash_message'] = ['Successfully create event!', 'success'];
                     mysqli_close($connect);
                     header('location: ../event/list.php');
                     exit();
                  } else {
                     $_SESSION['flash_message'] = ['Failed to upload the logo file!', 'danger'];
                  }
               } else {
                  $_SESSION['flash_message'] = ['Invalid logo file extension!', 'danger'];
               }
            } else {
               // Submit data without logo
               $stmt = $connect->prepare("INSERT INTO kegiatan(nama, img, konten, waktu_mulai, waktu_akhir)
                  VALUES(?, ?, ?, ?, ?)");

               $stmt->bind_param("sssss", $title, $image, $content, $start_datetime, $end_datetime);
               $stmt->execute();

               $_SESSION['flash_message'] = ['Successfully create event!', 'success'];
               mysqli_close($connect);
               header('location: ../event/list.php');
               exit();
            }
         } else {
            $_SESSION['flash_message'] = ['Failed to upload the image file!', 'danger'];
         }
      } else {
         $_SESSION['flash_message'] = ['Invalid image file extension!', 'danger'];
      }
   } else if ($title != '') {
      // Submit data without image and logo
      $stmt = $connect->prepare("INSERT INTO kegiatan(nama, konten, waktu_mulai, waktu_akhir)
         VALUES(?, ?, ?, ?)");

      $stmt->bind_param("ssss", $title, $content, $start_datetime, $end_datetime);
      $stmt->execute();

      $_SESSION['flash_message'] = ['Successfully create event!', 'success'];
      mysqli_close($connect);
      header('location: ../event/list.php');
      exit();
   } else {
      $_SESSION['flash_message'] = ['Please provide a title!', 'danger'];
   }
}
