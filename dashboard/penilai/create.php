<?php include '../templates/header.php' ?>

<h1 class="tes">Assing New Penilai</h1>
<hr>
<div class="row">
    <form action="../process/assignPenilai.php" method="post" enctype="multipart/form-data" class="col-lg-9">
        <div class="mb-3">
            <label for="user" class="form-label">User Email List</label>
            <select name="user" class="form-select" id="user">
                <?php
                // Call connection
                include "../../connect.php";
                $sql = "SELECT * FROM `user` WHERE role=0";
                $all_users = mysqli_query($connect, $sql);
                // using this loop to take the data
                // $all_categories variable means all of them wkwk
                // eventually print them individually
                // ndak bisa basa enggress

                // Start of the loop
                while ($user = mysqli_fetch_array(
                    $all_users,
                    MYSQLI_ASSOC
                )) :;
                ?>
                    <option value="<?php echo $user["id"]; ?>">
                        <?php echo $user["email"]; ?>
                    </option>
                <?php
                endwhile;
                // Akhir dari loop
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="kegiatan" class="form-label">List Kegiatan</label>
            <select name="kegiatan" class="form-select" id="kegiatan">
                <?php
                // Call connection
                include "../../connect.php";
                $sql = "SELECT * FROM `kegiatan`";
                $all_kegiatan = mysqli_query($connect, $sql);
                // using this loop to take the data
                // $all_categories variable means all of them wkwk
                // eventually print them individually
                // ndak bisa basa enggress

                // Start of the loop
                while ($kegiatan = mysqli_fetch_array(
                    $all_kegiatan,
                    MYSQLI_ASSOC
                )) :;
                ?>
                    <option value="<?php echo $kegiatan["id"]; ?>">
                        <?php echo $kegiatan["nama"] . " " . $kegiatan['waktu_mulai'] ?>
                    </option>
                <?php
                endwhile;
                // Akhir dari loop
                ?>
            </select>
        </div>
        <div class="mb-3 d-md-flex justify-content-md-end">
            <button name="submit" type="submit" class="btn btn-success">Assign</button>
        </div>
    </form>
</div>
</article>
</main>
</div>
<script>
    document.addEventListener('trix-file-accept', (e) => e.preventDefault())

    $(document).ready(() => {
        $('#img').change(() => {
            const file = $('#img').prop('files')[0]
            if (file) {
                let reader = new FileReader()
                reader.onload = (event) => $('.image-preview').attr('src', event.target.result)
                reader.readAsDataURL(file)
            }
        })
    })
</script>

<?php include '../templates/footer.php' ?>