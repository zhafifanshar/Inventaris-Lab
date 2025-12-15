<?php
include "../config/koneksi.php";
mysqli_query($conn,"DELETE FROM alat WHERE id_alat='$_GET[id]'");
header("location:index.php");
