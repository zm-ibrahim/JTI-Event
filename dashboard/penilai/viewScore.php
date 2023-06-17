<?php
include '../templates/header.php';
include '../../connect.php';

// Get data from selected user
$pid = $_GET['pid'];
$pname = $_GET['pname'];
?>

<h1>Score List</h1>
<strong>
    <small>Showing Score assigned by : <?php echo "$pname" ?></small>
</strong>
<hr>
<?php
if (isset($_SESSION['flash_message'])) { ?>
    <div class="alert alert-<?= $_SESSION['flash_message'][1] ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['flash_message'][0] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    unset($_SESSION['flash_message']);
} ?>
<table class="table table-striped mb-5">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Peserta</th>
            <th scope="col">Kegiatan</th>
            <th scope="col">Skor</th>
            <!-- <th scope="col">Action</th> -->
        </tr>
    </thead>
    <tbody>
        <?php
        // Limiter Module
        $batas = 5;
        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

        // Page number
        $previous = $halaman - 1;
        $next = $halaman + 1;

        //get actual data
        $sql = " SELECT skor.id,
                user.nama AS user_nama,
                penilai.nama AS penilai_nama,
                kegiatan.nama AS kegiatan_nama,
                skor.skor AS skor FROM skor
            JOIN user ON skor.user = user.id
            JOIN penilai ON skor.penilai = penilai.id
            JOIN kegiatan ON skor.kegiatan = kegiatan.id";
        $articles = mysqli_query($connect, $sql);

        $jumlah_data = mysqli_num_rows($articles);
        $total_halaman = ceil($jumlah_data / $batas);

        //limiting data
        $query = "$sql limit $halaman_awal, $batas";
        $articles = mysqli_query($connect, $query);

        if (mysqli_num_rows($articles) > 0) {
            $i = 1;
            foreach ($articles as $article) {
        ?>
                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $article['user_nama'] ?></td>
                    <td><?= $article['kegiatan_nama'] ?></td>
                    <td><?= $article['skor'] ?></td>
                    <!-- <td> -->
                    <!-- a_id means article_id -->
                    <!-- <a href="../article/view.php?a_id=<?= $article['article_id'] ?>&userpost=<?= $username ?>" class="badge bg-info">
                        <i data-feather="eye"></i>
                    </a>
                    <a href="../process/deleteArticle.php?a_id=<?= $article['article_id'] ?>&true=<?= 1 ?>" class="badge bg-danger">
                        <i data-feather="trash-2"></i>
                    </a>
                    </td> -->
                </tr>
        <?php
                $i++;
            }
        }
        ?>
    </tbody>
</table>
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
</article>
</main>
</div>

<?php include '../templates/footer.php'; ?>