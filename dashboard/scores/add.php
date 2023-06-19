<?php
include '../templates/header.php';
include "../../connect.php";

if ($role == 1) {
    $pid = $_GET['pid'];
    $kegid = $_GET['kegid'];
    $keguid = $_GET['keguid'];
    $sql = "SELECT u.nama FROM user u
    JOIN kegiatan_user ku ON u.id = ku.user_id
    WHERE u.id=$keguid";
    $score = mysqli_query($connect, $sql);
    $score = $score->fetch_assoc();
?>
    <h1 class="tes">Add Score</h1>
    <p>for user <?= $score['nama'] ?></p>
    <hr>
    <div class="row">
        <form action="../process/addScore.php" method="post" enctype="multipart/form-data" class="col-lg-9">
            <input type="hidden" name="kegiatan" value="<?= $kegid ?>">
            <input type="hidden" name="user" value="<?= $keguid ?>">
            <input type="hidden" name="penilai" value="<?= $pid ?>">
            <div class="mb-3">
                <label for="skor" class="form-label">Score</label>
                <input name="skor" type="number" class="form-control" id="skor" placeholder="Add Score For User" required>
            </div>
            <div class="mb-3 d-md-flex justify-content-md-end">
                <button name="submit" type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
    </article>
    </main>
    </div>
<?php include '../templates/footer.php';
}
?>