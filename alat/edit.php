<?php
include "../layout/header.php";
include "../config/koneksi.php";
$id=$_GET['id'];
$d=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM alat WHERE id_alat='$id'"));

if(isset($_POST['update'])){
mysqli_query($conn,"UPDATE alat SET
nama_alat='$_POST[nama]',
jumlah='$_POST[jumlah]',
kondisi='$_POST[kondisi]',
keterangan='$_POST[keterangan]'
WHERE id_alat='$id'");
header("location:index.php");
}
?>
<form method="post">
<input name="nama" value="<?= $d['nama_alat'] ?>" class="form-control mb-2">
<input name="jumlah" value="<?= $d['jumlah'] ?>" class="form-control mb-2">
<select name="kondisi" class="form-control mb-2">
<option <?= $d['kondisi']=='Baik'?'selected':'' ?>>Baik</option>
<option <?= $d['kondisi']=='Rusak'?'selected':'' ?>>Rusak</option>
</select>
<textarea name="keterangan" class="form-control mb-2"><?= $d['keterangan'] ?></textarea>
<button name="update" class="btn btn-success">Update</button>
</form>
<?php include "../layout/footer.php"; ?>
