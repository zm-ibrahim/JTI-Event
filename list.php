<?php include 'templates/header.php';
?>

<main class="container mt-4">
    <h1 class="mb-4 text-center">Semua Kegiatan</h1>
    <div class="row">
        <?php
        // Limiter Module
        $batas = 6;
        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

        // Page Number
        $previous = $halaman - 1;
        $next = $halaman + 1;

        // Get actual rows of data
        if (isset($_GET['s'])) {
            $search = $_GET['s'];
            $sql = "SELECT id, nama, konten, img, waktu_mulai AS start, waktu_akhir AS end FROM kegiatan AS k
            WHERE konten LIKE '%$search%' OR nama LIKE '%$search%' ORDER BY `start` DESC";
        } else {
            $sql = "SELECT id, nama, konten, img, waktu_mulai AS start, waktu_akhir AS end FROM kegiatan AS k
            ORDER BY `start` DESC";
        }
        $articles = mysqli_query($connect, $sql);
        $jumlah_data = mysqli_num_rows($articles);
        $total_halaman = ceil($jumlah_data / $batas);

        // limiting data
        $query = "$sql limit $halaman_awal, $batas";
        $articles = mysqli_query($connect, $query);

        if (mysqli_num_rows($articles) > 0) {
            foreach ($articles as $article) {
                $excerpt = array_slice(explode(" ", $article['konten']), 0, 15);
                $excerpt = strip_tags(implode(' ', $excerpt), '<ol><ul><li>') . '...';
        ?>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 bg_green">
                        <div class="card card_hover">
                            <?php
                            if ($article['img'] != '') {
                            ?>
                                <img src="<?= $article['img'] ?>" class="self-align-center">
                            <?php
                            } else {
                            ?>
                                <img src="img/nopicture.jpg" style="max-height: 170px;" class="align-self-center">
                            <?php
                            }
                            ?>
                            <div class="card-body">
                                <a class="fs-4 card-title text-decoration-none text-capitalize" href="view.php?kid=<?= $article['id'] ?>"><?= $article['nama'] ?></a>
                                <br>
                                <!-- <h5 class="card-title">/h5> -->
                                <small class="card-text text-muted">Waktu Mulai : <?= $article['start'] ?> <br> Waktu Akhir <?= $article['end'] ?></small>
                                <p class="card-text"><?= $excerpt ?></p>
                                <a href="view.php?kid=<?= $article['id'] ?>">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <!-- Pagination Module -->
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" <?php if ($halaman > 1) {
                                                    echo "href='?halaman=$previous'";
                                                } ?>>Previous</a>
                    </li>
                    <?php
                    for ($x = 1; $x <= $total_halaman; $x++) {
                    ?>
                        <li class="page-item"><a class="page-link" href="?halaman=<?= $x ?>"><?= $x; ?></a></li>
                    <?php
                        // var_dump($total_halaman);
                    }
                    ?>
                    <li class="page-item">
                        <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                    echo "href='?halaman=$next'";
                                                } ?>>Next</a>
                    </li>
                </ul>
            </nav>
        <?php
        } else {
        ?>
            <p class="text-center">Nothing to Found</p>
        <?php
        }
        ?>
    </div>
</main>

<?php include 'templates/footer.php'; ?>