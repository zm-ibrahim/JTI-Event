<?php include '../templates/header.php' ?>

<h1 class="tes">Buat Kegiatan Baru</h1>
<hr>
<div class="row">
    <form action="../process/createEvent.php" method="post" enctype="multipart/form-data" class="col-lg-9">
        <div class="mb-3">
            <label for="name" class="form-label">Judul Kegiatan</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Masukkan Judul" required>
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Image</label>
            <input name="img" class="form-control" type="file" id="img" accept="image/png, image/gif, image/jpeg, image/webp">
            <!-- image preview -->
            <img class="img-fluid col-sm-9 mt-3 img-preview" src="" alt="">
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label">Logo Sertif</label>
            <input name="logo" class="form-control" type="file" id="logo" accept="image/png, image/gif, image/jpeg, image/webp">
            <!-- image preview -->
            <img class="img-fluid col-sm-9 mt-3 logo-preview" src="" alt="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Waktu Mulai</label>
            <br>
            <label class="form-label">Date:</label>
            <input type="date" name="tanggal-mulai" class="form-control" required />
            <label class="form-label">Time:</label>
            <input type="time" name="waktu-mulai" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Waktu Akhir</label>
            <br>
            <label class="form-label">Date:</label>
            <input type="date" name="tanggal-akhir" class="form-control" required />
            <label class="form-label">Time:</label>
            <input type="time" name="waktu-akhir" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Content</label>
            <input id="x" type="hidden" name="konten">
            <trix-editor input="x"> </trix-editor>
        </div>
        <div class="mb-3 d-md-flex justify-content-md-end">
            <button name="submit" type="submit" class="btn btn-success">Submit</button>
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