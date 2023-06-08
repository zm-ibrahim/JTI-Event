<?php
include '../templates/header.php';
include '../../connect.php';

$kid = $_GET['kid']; // Assuming you are passing the event ID as a query parameter

// Retrieve the existing event data
$sql = "SELECT * FROM kegiatan WHERE id = $kid";
$result = mysqli_query($connect, $sql);
$event = mysqli_fetch_assoc($result);

// Assign the existing data to variables
$title = $event['nama'];
$img = $event['img'];
$logo = $event['logo'];
$content = $event['konten'];
$start = $event['waktu_mulai'];
$end = $event['waktu_akhir'];

?>

<h1 class="tes">Update Kegiatan</h1>
<hr>
<div class="row">
    <form action="../process/updateArticle.php" method="post" enctype="multipart/form-data" class="col-lg-9">
        <div class="mb-3">
            <label for="name" class="form-label">Judul Kegiatan</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Masukkan Judul" required value="<?= $title ?>">
        </div>
        <!-- Rest of the form code with other input fields -->

        <!-- Add the values to the respective input fields -->
        <div class="mb-3">
            <label for="img" class="form-label">Image</label>
            <input name="file" class="form-control" type="file" id="img" accept="image/png, image/gif, image/jpeg, image/webp">
            <!-- image preview -->
            <img class="img-fluid col-sm-9 mt-3 image-preview" src="<?= $img ?>" alt="">
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label">Logo Sertif</label>
            <input name="file" class="form-control" type="file" id="logo" accept="image/png, image/gif, image/jpeg, image/webp">
            <!-- image preview -->
            <img class="img-fluid col-sm-9 mt-3 image-preview" src="<?= $logo ?>" alt="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Waktu Mulai</label>
            <label class="form-label">Date:</label>
            <input type="date" name="tanggal-mulai" class="form-control" value="<?= $start ?>" />
            <label class="form-label">Time:</label>
            <input type="time" name="waktu-mulai" class="form-control" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Waktu Akhir</label>
            <label class="form-label">Date:</label>
            <input type="date" name="tanggal-akhir" class="form-control" value="<?= $end ?>" />
            <label class="form-label">Time:</label>
            <input type="time" name="waktu-akhir" class="form-control" />
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Content</label>
            <input id="x" type="hidden" name="konten" value="<?= $content ?>">
            <trix-editor input="x"></trix-editor>
        </div>
        <div class="mb-3 d-md-flex justify-content-md-end">
            <button type="submit" name="submit" class="btn btn-success">Save</button>
        </div>
    </form>
</div>

<?php include '../templates/footer.php' ?>