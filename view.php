<?php
include 'templates/header.php';
$kid = $_GET['kid'];

$sql = "SELECT nama, konten, img, waktu_mulai, waktu_akhir FROM kegiatan AS k WHERE id = $kid";
$article = mysqli_query($connect, $sql);
$article = $article->fetch_assoc();
?>
<main class="container mt-4">
    <section class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-left">
                <?php if ($article['img'] != '') { ?>
                    <img class="card-img-top mr-3 mb-4" src="<?= $article['img'] ?>" alt="article image" style="height: auto; max-height: 300px; width: auto; max-width: 100%;">
                <?php } ?>
            </div>
            <div class="">
                <h2 class="mb-4 text-capitalize"><?= $article['nama'] ?></h2>
                <small class="text-muted">Waktu Mulai: <?= $article['waktu_mulai'] ?> | Selesai: <?= $article['waktu_akhir'] ?></small>
                <article class="my-3">
                    <?= $article['konten'] ?>
                </article>
                <hr>
                <?php if ((isset($_SESSION['role']) && $_SESSION['role'] == 0)) { ?>
                    <button class="btn btn-success" onclick="enroll()">Ikuti</button>
                <?php } else { ?>
                    <small>Anda harus membuat akun peserta untuk dapat mengikuti kegiatan</small>
                <?php } ?>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    function enroll() {
                        $.ajax({
                            type: 'POST',
                            url: 'process/enroll.php',
                            data: {
                                kid: '<?= $kid ?>'
                            },
                            success: function(response) {
                                // Handle the response here
                                if (response === 'success') {
                                    alert('Enrollment successful!');
                                } else if (response === 'already_enrolled') {
                                    alert('You are already enrolled in this activity.');
                                } else {
                                    alert('Enrollment failed. Please try again.');
                                }
                            },
                            error: function(xhr, status, error) {
                                // Handle the error here
                                console.log(error);
                            }
                        });
                    }
                </script>
            </div>
        </div>
    </section>
</main>
<?php include 'templates/footer.php' ?>