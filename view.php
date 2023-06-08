<?php
include 'templates/header.php';
$kid = $_GET['kid'];

$sql = "SELECT nama, konten, img, waktu_mulai, waktu_akhir FROM kegiatan AS k WHERE id = $kid";
$article = mysqli_query($connect, $sql);
$article = $article->fetch_assoc();

// Get current date and time
$currentDateTime = new DateTime();
$currentDateTime->setTimezone(new DateTimeZone('Asia/Jakarta'));

// Convert start and end times to DateTime objects
$startDateTime = new DateTime($article['waktu_mulai'], new DateTimeZone('Asia/Jakarta'));
$endDateTime = new DateTime($article['waktu_akhir'], new DateTimeZone('Asia/Jakarta'));

$isStarted = ($currentDateTime >= $startDateTime);

?>
<main class="container mt-4">
    <section class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-left">
                <?php if ($article['img'] != '') { ?>
                    <img class="card-img-top mr-3 mb-4" src="<?= $article['img'] ?>" alt="article image" style="height: auto; max-height: 300px; width: auto; max-width: 100%;">
                <?php } ?>
            </div>
            <div class="col-md-8">
                <h2 class="mb-4 text-capitalize"><?= $article['nama'] ?></h2>
                <small class="text-muted">Waktu Mulai: <?= $startDateTime->format('Y-m-d H:i:s') ?> | Selesai: <?= $endDateTime->format('Y-m-d H:i:s') ?></small>
                <div class="w-100">
                    <?= $article['konten'] ?>
                </div>
                <hr>
                <?php if ((isset($_SESSION['role']) && $_SESSION['role'] == 0)) { ?>
                    <button class=" btn btn-success" onclick="enroll()">Ikuti</button>
                    <?php if ($isStarted) { ?>
                        <script>
                            alert('Event already started.');
                        </script>
                    <?php } ?>
                <?php } else { ?>
                    <small>Anda harus membuat akun peserta untuk dapat mengikuti kegiatan</small>
                <?php } ?>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    function enroll() {
                        <?php if ($isStarted) { ?>
                            alert('Event already started.');
                            return;
                        <?php } ?>
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