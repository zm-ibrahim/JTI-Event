<?php
include '../templates/header.php';
include '../../connect.php';
// var_dump($query);
$userid = $_SESSION['user_id'];
?>

<h1>My Event</h1>
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
<div class="table-responsive">
    <table class="table table-striped mb-5">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Kegiatan</th>
                <th scope="col">Nama Penilai</th>
                <th scope="col">Action</th>
            </tr>
            <?php
            ?>
        </thead>
        <tbody>
            <?php
            // Limitter module
            $batas = 5;
            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

            // Page number
            $previous = $halaman - 1;
            $next = $halaman + 1;

            // Get actual rows of data
            $sql = "SELECT k.id, k.nama AS namaK, p.nama AS namaP, p.kegiatan
                FROM kegiatan AS k
                JOIN penilai AS p ON k.id = p.kegiatan";
            $data = mysqli_query($connect, $sql);
            $jumlah_data = mysqli_num_rows($data);
            $total_halaman = ceil($jumlah_data / $batas);

            //Get title and category with limit set
            $query = "$sql limit $halaman_awal, $batas";
            $articles = mysqli_query($connect, $query);

            if (mysqli_num_rows($articles) > 0) {

                $i = $halaman_awal + 1;
                foreach ($articles as $article) {
            ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><?= $article['namaK'] ?></td>
                        <td><?= $article['namaP'] ?></td>
                        <td>
                            <!-- kid means kegiatan id -->
                            <a href="view.php?kid=<?= $article['id'] ?>" class="badge bg-info">
                                <i data-feather="eye"></i>
                            </a>
                            <a href="edit.php?kid=<?= $article['id'] ?>" class="badge bg-warning">
                                <i data-feather="edit"></i>
                            </a>
                            <a href="../process/deleteEvent.php?kid=<?= $article['id'] ?>" class="badge bg-danger">
                                <i data-feather="trash-2"></i>
                            </a>
                        </td>
                    </tr>
            <?php
                    $i++;
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php
if ((isset($role) && $role == 2)) {
?>
    <a class="btn btn-success" href="create.php">Assign New Penilai</a>
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
</article>
</main>
</div>

<!-- <script>
    function printCustomPage(articleId, userId) {
        var printWindow = window.open('sertif.php?kid=' + articleId + '&usid=' + userId, '_blank');
        printWindow.document.open();

        // Set the print styles
        printWindow.document.write(`
    <style>
      @media print {
        @page {
          size: landscape;
        }
        body {
          background: url('path/to/background-image.jpg') no-repeat center center fixed;
          background-size: cover;
        }
        header, footer {
          display: none;
        }
      }
    </style>
  `);

        printWindow.document.close();

        // Trigger the print function
        printWindow.print();
        printWindow.onafterprint = function() {
            printWindow.close();
        };
    }
</script> -->
<?php include '../templates/footer.php'; ?>