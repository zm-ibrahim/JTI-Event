<?php
include '../../connect.php';
include '../templates/header.php';

$user_id = $_GET['user_id'];
$username = $_GET['username'];
$query = "SELECT * FROM user WHERE id=$user_id LIMIT 1";
$article = mysqli_query($connect, $query);
$article = $article->fetch_assoc();
$stat = $article['role'];
if ($stat == 1) {
    $sql = "SELECT k.id, k.nama, waktu_mulai, waktu_akhir FROM kegiatan k JOIN penilai p ON k.id = kegiatan 
                WHERE p.id = (SELECT p.id FROM penilai p
                JOIN user u ON p.nama = u.username WHERE u.id = $user_id)";
} else {
    $sql = "SELECT k.* FROM kegiatan AS k JOIN kegiatan_user AS ku ON k.id = ku.kegiatan_id WHERE user_id = $user_id";
}

$kegiatans = mysqli_query($connect, $sql);
?>

<div class="col-lg-9">
    <h1>Detail Page </h1>
    <h3>for username : <?= $article['username'] ?></h3>
    <hr>
    <h5>Info</h5>
    <ul>
        <li>Nama : <?= $article['nama'] ?> </li>
        <li>Email : <?= $article['email'] ?></li>
        <li>Alamat : <?= $article['alamat'] ?></li>
        <li>Status : <?= $article['role'] == 1 ? 'penilai' : 'peserta' ?> </li>
    </ul>
    <hr>
    <h5>Kegiatan Yang diikuti : </h5>
    <?php
    if (mysqli_num_rows($kegiatans) > 0) {
        foreach ($kegiatans as $kegiatan) {
    ?>
            <ul>
                <li>Nama Kegiatan : <?= $kegiatan['nama'] ?></li>
                <li>Mulai : <?= $kegiatan['waktu_mulai'] ?></li>
                <li>Selesai : <?= $kegiatan['waktu_akhir'] ?></li>
            </ul>
    <?php
        }
    }
    ?>

</div>
</main>
</div>

<?php include '../templates/footer.php'; ?>