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
        <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Judul Kegiatan</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Masukkan Judul" required value="<?php echo $event['nama']; ?>">
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Image</label>
            <input name="img" class="form-control" type="file" id="img" accept="image/png, image/gif, image/jpeg, image/jpg, image/webp">
            <!-- image preview -->
            <img class="img-fluid col-sm-9 mt-3 img-preview" src="<?php echo $event['img']; ?>" alt="">
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label">Logo Sertif</label>
            <input name="logo" class="form-control" type="file" id="logo" accept="image/png, image/gif, image/jpeg, image/jpg, image/webp">
            <!-- image preview -->
            <img class="img-fluid col-sm-9 mt-3 logo-preview" src="<?php echo $event['logo']; ?>" alt="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Waktu Mulai</label>
            <br>
            <label class="form-label">Date:</label>
            <input type="date" name="tanggal-mulai" class="form-control" required value="<?php echo date('Y-m-d', strtotime($event['waktu_mulai'])); ?>" />
            <label class="form-label">Time:</label>
            <input type="time" name="waktu-mulai" class="form-control" required value="<?php echo date('H:i', strtotime($event['waktu_mulai'])); ?>" />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Waktu Akhir</label>
            <br>
            <label class="form-label">Date:</label>
            <input type="date" name="tanggal-akhir" class="form-control" required value="<?php echo date('Y-m-d', strtotime($event['waktu_akhir'])); ?>" />
            <label class="form-label">Time:</label>
            <input type="time" name="waktu-akhir" class="form-control" required value="<?php echo date('H:i', strtotime($event['waktu_akhir'])); ?>" />
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Content</label>
            <input id="x" type="hidden" name="konten" value="<?php echo $event['konten']; ?>">
            <trix-editor input="x"> </trix-editor>
        </div>
        <div class="mb-3 d-md-flex justify-content-md-end">
            <button name="submit" type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
</div>
</article>
</main>
</div>
<script>
    document.addEventListener('trix-file-accept', (e) => e.preventDefault());

    $(document).ready(() => {
        $('#img').change(() => {
            const file = $('#img').prop('files')[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = (event) => $('.img-preview').attr('src', event.target.result);
                reader.readAsDataURL(file);
            }
        });

        $('#logo').change(() => {
            const file = $('#logo').prop('files')[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = (event) => $('.logo-preview').attr('src', event.target.result);
                reader.readAsDataURL(file);
            }
        });
    });
</script>

<?php include '../templates/footer.php' ?>