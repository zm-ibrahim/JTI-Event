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
            background-image: url("img/bgsertif.png");
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
    </style>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet"> <!-- Add the Playfair Display font -->
</head>

<body>
    <?php
    $nama = "Lukman Hakim";
    $role = "Participant";
    $judul = "Latihan UTBK";
    $date = "20 May 2023";
    $namattd = "Zaky Muhammad Ibrahim";
    ?>
    <div class="container">
        <img class="logo" src="img/logopoltek.png" alt="Logo">
        <div class="title">Certificate of Completion</div>
        <div class="subtitle">Awarded to</div>
        <div class="name"><?= $nama ?></div>
        <hr class="line">
        <img class="signature" src="img/TTD.png" alt="Signature">
        <div class="signature-name"><?= $namattd ?></div>
        <div class="subtitle">For successfully completing <?= $judul ?> event as <?= $role ?></div>
        <!-- <div class="title"><?= $judul ?></div> -->
        <div class="date"><?= $date ?></div>
    </div>
</body>
<script type="text/javascript">
    window.print();
</script>

</html>