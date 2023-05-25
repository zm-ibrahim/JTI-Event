<?php
include '../../connect.php';
define('baseURL', explode('dashboard', $_SERVER['REQUEST_URI'])[0]);
session_start();

if (isset($_POST['submit'])) {
   $title = $_POST['nama'];
   $img = $_POST['img'];
   $logo = $_POST['logo'];
   $content = $_POST['konten'];
   $id = $_SESSION['user_id'];

   if ($_FILES['file']['name'] != '' && $title != '') { // is image file avaible?
      // Image Cek
      $image = "img" . rand(-2147483648, 2147483647) . "." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
      $target_dir = "../../img/event/";
      $target_file = $target_dir . basename($_FILES["file"]["name"]);

      // Select file type
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      // Valid file extensions
      $extensions_arr = array("jpg", "jpeg", "png", "gif", "webp");

      // Check extension
      if (in_array($imageFileType, $extensions_arr)) {
         // Upload file
         if (move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $image)) {
            // Submit data
            $image = baseURL . 'img/event/' . $image;
            $stmt = $connect->prepare("INSERT INTO kegiatan(title, img, konten, waktu_mulai, waktu_akhir)
               VALUES(?, ?, ?, ?, ?)");

            $stmt->bind_param("ssiis", $title, $image, $category, $id, $content);
            $stmt->execute();

            $_SESSION['flash_message'] = ['Successfully create event!', 'success'];
         } else $_SESSION['flash_message'] = ['Cant upload file!', 'danger'];
      } else $_SESSION['flash_message'] = ['Can only upload image file!', 'danger'];
   } else if ($title != '') {
      $stmt = $connect->prepare("INSERT INTO kegiatan(title, category_id, user_id, content)
               VALUES(?, ?, ?, ?)");

      $stmt->bind_param("siis", $title, $category, $id, $content);
      $stmt->execute();

      $_SESSION['flash_message'] = ['Successfully create article!', 'success'];
   }

   mysqli_close($connect);
   header('location: ../article/list.php');
}
