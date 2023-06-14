<?php
include '../../connect.php';
session_start();
// get kegiatan id dan user id
$kid = $_GET['kid'];
$usid = $_GET['usid'];
$role = $_SESSION['role'];

// Set
if ($role == 1) {
    $role = "Penilai";
} else if ($role == 0) {
    $role = "Peserta";
}

// Query untuk ambil user
$sql = "SELECT * FROM user WHERE id=$usid";
$profile = mysqli_query($connect, $sql);
$profile = $profile->fetch_assoc();

// Query untuk ambil kegiatan
$query = "SELECT nama, img, logo, konten, waktu_mulai, waktu_akhir FROM kegiatan WHERE id=$kid LIMIT 1";
$article = mysqli_query($connect, $query);
$article = $article->fetch_assoc();

$end = new DateTime($article['waktu_akhir']);
$endDate = $end->format('Y-m-d');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Certificate</title>
    <style>
        body {
            background-color: #f1f1f1;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: auto;
            height: 716px;
            background-image: url("../../img/bgsertif.png");
            /* Add the background image */
            background-size: cover;
            /* Scale the background image to cover the entire container */
            background-position: center center;
            /* Center the background image */
            background-repeat: no-repeat;
            /* Prevent the background image from repeating */
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            padding-top: 180px;
            box-sizing: border-box;
            position: relative;
            /* Make the container a positioned element */
            font-family: 'Playfair Display', serif;
            /* Set the font-family to Playfair Display */
        }

        .title {
            text-align: center;
            font-size: 60px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            font-size: 25px;
            margin-bottom: 50px;
        }

        .name {
            text-align: center;
            font-size: 45px;
            font-weight: bold;
            margin-bottom: 50px;
            /* text-decoration: underline; */
        }

        .date {
            text-align: right;
            margin-top: 30px;
            margin-right: 20px;
            font-size: 20px;
            font-style: italic;
        }

        .line {
            margin-top: -20px;
            width: 300px;
        }

        .signature {
            position: absolute;
            /* Position the signature within the container */
            bottom: 0;
            right: 0;
            width: 150px;
            height: 150px;
            /* transform: rotate(-15deg); */
            /* Rotate the signature */
        }

        .signature-name {
            position: absolute;
            bottom: 5px;
            right: 0;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            width: 200px;
        }

        .logo {
            position: absolute;
            /* Position the logo within the container */
            top: 5px;
            left: 15px;
            width: 100px;
            height: 100px;
        }

        @page {
            size: landscape;
        }

        header,
        footer {
            display: none;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet"> <!-- Add the Playfair Display font -->
</head>

<body>
    <?php
    // $nama = "Lukman Hakim";
    // $role = "Participant";
    // $judul = "Latihan UTBK";
    // $date = "20 May 2023";
    // $namattd = "Zaky Muhammad Ibrahim";
    ?>
    <div class="container">
        <?php if (!empty($article['logo'])) { ?>
            <img class="logo" src="../../img/<?= $article['logo'] ?>" alt="Logo">
        <?php } else { ?>
            <img class="logo" src="../../img/logosertif.png" alt="Default Logo">
        <?php } ?>
        <div class="title">Certificate of Completion</div>
        <div class="subtitle">Awarded to</div>
        <div class="name"><?= $profile['nama'] ?></div>
        <hr class="line">
        <!-- <img class="signature" src="img/TTD.png" alt="Signature">
    <div class="signature-name"><?= $namattd ?></div> -->
        <div class="subtitle">For successfully completing <?= $article['nama'] ?> event as <?= $role ?></div>
        <div class="date"><?= $endDate ?></div>
    </div>

</body>
<script type="text/javascript">
    // window.print();

    // Trigger the print function
    window.print();
    window.onafterprint = function() {
        window.close();
    };
</script>

</html>