<?php
include '../templates/header.php';
include "../../connect.php";

if ($role == 1) {
    $idskor = $_GET['idskor'];
    $sql = "SELECT s.skor, u.nama FROM skor s
    JOIN user u ON s.user = u.id
    WHERE s.id=$idskor";
    $score = mysqli_query($connect, $sql);
    $score = $score->fetch_assoc();

?>

    <h1 class="tes">Edit Score</h1>
    <p>for <?= $score['nama'] ?></p>
    <hr>
    <div class="row">
        <form action="../process/updateScore.php" method="post" class="col-lg-9">
            <input type="hidden" name="idskor" value="<?= $idskor ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Skor</label>
                <input name="skor" value="<?= $score['skor'] ?>" type="number" class="form-control" id="name" placeholder="Enter Score Value" required>
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