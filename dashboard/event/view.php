<?php
include '../../connect.php';
include '../templates/header.php';

$kid = $_GET['kid'];
$query = "SELECT nama, img, logo, konten, waktu_awal, waktu_akhir FROM kegiatan WHERE id=$kid LIMIT 1";
$article = mysqli_query($connect, $query);
$article = $article->fetch_assoc(); //return nilai dalam bentuk array associative

// Checking role for viewing
// if ($role != 2) {
//     // Throw if this isn't the user's article
//     if ($id != $article['user_id']) {
//         header('Location: ' . baseURL . 'dashboard');
//     }
// } else {
//     if (isset($_GET['userpost'])) {
//         // Getting author's username 
//         $userpost = $_GET['userpost'];
//         echo "<strong>Showing article by $userpost </strong>";
//     }
// }

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