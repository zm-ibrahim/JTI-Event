<?php
include 'templates/header.php';
$kid = $_GET['kid'];

$sql = "SELECT nama, konten, img, waktu_mulai, waktu_akhir FROM kegiatan AS k";
$article = mysqli_query($connect, $sql);
$article = $article->fetch_assoc();
?>
<main class="container mt-4">
    <section class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4 text-capitalize"><?= $article['nama'] ?></h2>
            <?php
            if ($article['img'] != '') { ?>
                <div class="d-flex align-items-center">
                    <img class="card-img-top" src="<?= $article['img'] ?>" alt="article image">
                </div>
            <?php
            }
            ?>
            <small class="text-muted">Waktu Mulai : <?= $article['waktu_mulai'] ?> | Selesai : <?= $article['waktu_akhir'] ?></small>
            <article class="my-3">
                <?= $article['konten'] ?>
            </article>
        </div>
    </section>
</main>

<?php include 'templates/footer.php' ?>