<?php
include "../layout/header.php";
include "../config/koneksi.php";

$alat = mysqli_query($conn,"SELECT * FROM alat");

if(isset($_POST['simpan'])){
    $id_alat = $_POST['id_alat'];
    $id_user = $_SESSION['id_user'];
    $tgl = date('Y-m-d');

    mysqli_query($conn,"
        INSERT INTO peminjaman (id_user, id_alat, tgl_pinjam, status)
        VALUES ($id_user, $id_alat, '$tgl', 'Dipinjam')
    ");

    header("location:index.php");
}
?>

<h3 class="mb-4">➕ Peminjaman Alat</h3>

<div class="card p-4">
<form method="post">
    <label>Pilih Alat</label>
    <select name="id_alat" class="form-control mb-3" required>
        <?php while($a=mysqli_fetch_assoc($alat)){ ?>
        <option value="<?= $a['id_alat'] ?>">
            <?= $a['nama_alat'] ?>
        </option>
        <?php } ?>
    </select>

    <button name="simpan" class="btn btn-primary">Pinjam</button>
</form>
</div>

<?php include "../layout/footer.php"; ?>
