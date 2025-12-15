<?php
include "../layout/header.php";
include "../config/koneksi.php";

if(isset($_POST['simpan'])){
mysqli_query($conn,"INSERT INTO alat VALUES(
NULL,'$_POST[nama]','$_POST[jumlah]','$_POST[kondisi]','$_POST[keterangan]'
)");
header("location:index.php");
}
?>
<form method="post">
<input name="nama" class="form-control mb-2" placeholder="Nama Alat">
<input name="jumlah" type="number" class="form-control mb-2">
<select name="kondisi" class="form-control mb-2">
<option>Baik</option>
<option>Rusak</option>
</select>
<textarea name="keterangan" class="form-control mb-2"></textarea>
<button name="simpan" class="btn btn-success">Simpan</button>
</form>
<?php include "../layout/footer.php"; ?>
