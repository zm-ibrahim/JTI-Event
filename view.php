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
            <div class="d-flex">
                <?php if ($article['img'] != '') { ?>
                    <img class="card-img-top mr-3" src="<?= $article['img'] ?>" alt="article image" style="height: auto; max-height: 300px; width: auto; max-width: 100%;">
                <?php } ?>
                <div>
                    <h2 class="mb-4 text-capitalize"><?= $article['nama'] ?></h2>
                    <small class="text-muted">Waktu Mulai: <?= $article['waktu_mulai'] ?> | Selesai: <?= $article['waktu_akhir'] ?></small>
                    <article class="my-3">
                        <?= $article['konten'] ?>
                    </article>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'templates/footer.php' ?>