<?php
include 'templates/header.php';
?>
<style>
    .card-started {
        border: 2px solid orange;
    }

    .card-ended {
        opacity: 0.5;
        pointer-events: none;
    }

    .label-started {
        background-color: orange;
        color: white;
        padding: 4px 8px;
        font-size: 12px;
        border-radius: 4px;
    }
</style>

<main class="container mt-4">
    <h1 class="mb-4 text-center">Semua Kegiatan</h1>
    <div class="row">
        <?php
        // Get current date and time
        $currentDateTime = new DateTime();

        // Limiter Module
        $batas = 6;
        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

        // Get actual rows of data
        if (isset($_GET['s'])) {
            $search = $_GET['s'];
            $sql = "SELECT id, nama, konten, img, waktu_mulai AS start, waktu_akhir AS end FROM kegiatan AS k
        WHERE (konten LIKE '%$search%' OR nama LIKE '%$search%') AND waktu_akhir >= '" . $currentDateTime->format('Y-m-d H:i:s') . "' ORDER BY `start` DESC";
        } else {
            $sql = "SELECT id, nama, konten, img, waktu_mulai AS start, waktu_akhir AS end FROM kegiatan AS k
        WHERE waktu_akhir >= '" . $currentDateTime->format('Y-m-d H:i:s') . "' ORDER BY `start` DESC";
        }

        $articles = mysqli_query($connect, $sql);
        $jumlah_data = mysqli_num_rows($articles);
        $total_halaman = ceil($jumlah_data / $batas);

        // Limiting data
        $query = "$sql LIMIT $halaman_awal, $batas";
        $articles = mysqli_query($connect, $query);

        if (mysqli_num_rows($articles) > 0) {
            foreach ($articles as $article) {
                $excerpt = array_slice(explode(" ", $article['konten']), 0, 15);
                $excerpt = strip_tags(implode(' ', $excerpt), '<ol><ul><li>');

                // Convert start and end times to DateTime objects
                $startDateTime = new DateTime($article['start'], new DateTimeZone('Asia/Jakarta')); // Replace 'Asia/Jakarta' with your actual timezone
                $endDateTime = new DateTime($article['end'], new DateTimeZone('Asia/Jakarta')); // Replace 'Asia/Jakarta' with your actual timezone

                // Check if the event has started or ended
                $isStarted = ($currentDateTime >= $startDateTime);
                $isEnded = ($currentDateTime > $endDateTime);

                // Determine the card class based on the event status
                $cardClass = ($isEnded) ? 'card-ended' : ($isStarted ? 'card-started' : '');

                // Determine the card link based on the event status
                $cardLink = ($isEnded) ? '#' : 'view.php?kid=' . $article['id'];

        ?>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 bg_green <?= $cardClass ?>">
                        <div class="card card_hover">
                            <?php if ($article['img'] != '') { ?>
                                <img src="<?= $article['img'] ?>" class="self-align-center">
                            <?php } else { ?>
                                <img src="img/nopicture.jpg" style="max-height: 170px;" class="align-self-center">
                            <?php } ?>
                            <div class="card-body">
                                <a class="fs-4 card-title text-decoration-none text-capitalize" href="<?= $cardLink ?>">
                                    <?= $article['nama'] ?>
                                    <?php if ($isStarted) { ?>
                                        <span class="label-started"><?= $isEnded ? 'Ended' : 'Started' ?></span>
                                    <?php } ?>

                                </a>
                                <br>
                                <small class="card-text text-muted">Waktu Mulai: <?= $startDateTime->format('Y-m-d H:i:s') ?><br>Waktu Akhir: <?= $endDateTime->format('Y-m-d H:i:s') ?></small>
                                <p class="card-text"><?= $excerpt ?></p>
                                <?php if (!$isEnded) { ?>
                                    <a href="<?= $cardLink ?>">Read More</a>
                                <?php } ?>
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
                    <?php if ($halaman > 1) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $previous ?>">Previous</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($x = 1; $x <= $total_halaman; $x++) : ?>
                        <li class="page-item <?= ($x == $halaman) ? 'active' : '' ?>">
                            <a class="page-link" href="?halaman=<?= $x ?>"><?= $x ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($halaman < $total_halaman) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $next ?>">Next</a>
                        </li>
                    <?php endif; ?>
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