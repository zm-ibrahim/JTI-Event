<?php
include '../../connect.php';
include '../templates/header.php';

$kid = $_GET['kid'];
$query = "SELECT nama, img, logo, konten, waktu_mulai, waktu_akhir FROM kegiatan WHERE id=$kid LIMIT 1";
$article = mysqli_query($connect, $query);
$article = $article->fetch_assoc(); //return nilai dalam bentuk array associative
?>

<div class="col-lg-9">
    <h1><?= $article['nama'] ?></h1>
    <hr>

    <?php if ($article['img'] != '') { ?>
        <img class="card-img-top" src="<?= $article['img'] ?>" alt="image">
    <?php
    } ?>

    <article class="my-3">
        <?= $article['konten'] ?>
    </article>
</div>
</article>
</main>
</div>

<?php include '../templates/footer.php'; ?>