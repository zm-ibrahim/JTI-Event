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
                <?php
                if ((isset($role) && $role == 0)) {
                ?>
                    <a class="btn btn-success" href="process/enroll.php">Ikuti</a>
                <?php
                } else {
                ?>
                    <small>Anda harus membuat akun peserta untuk dapat mengikuti kegiatan</small>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

</main>

<?php include 'templates/footer.php' ?>