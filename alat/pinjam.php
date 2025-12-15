<?php
session_start();
include "../config/koneksi.php";

$id_user = $_SESSION['id_user'];
$id_alat = $_POST['id_alat'];
$jumlah  = (int) $_POST['jumlah'];
$tgl     = date('Y-m-d');

/* Ambil stok alat */
$alat = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT jumlah FROM alat WHERE id_alat = $id_alat")
);

if ($jumlah > $alat['jumlah']) {
    header("location:index.php?error=stok");
    exit;
}

/* Simpan peminjaman */
mysqli_query($conn, "
    INSERT INTO peminjaman (id_user, id_alat, jumlah, tgl_pinjam, status)
    VALUES ($id_user, $id_alat, $jumlah, '$tgl', 'Dipinjam')
");

/* Kurangi stok alat */
mysqli_query($conn, "
    UPDATE alat SET jumlah = jumlah - $jumlah
    WHERE id_alat = $id_alat
");

header("location:index.php?success");
