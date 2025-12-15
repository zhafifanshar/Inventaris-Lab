<?php
session_start();
include "../config/koneksi.php";

$id = (int) $_GET['id'];

/* Ambil data peminjaman */
$p = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM peminjaman WHERE id_pinjam = $id")
);

/* Update status */
mysqli_query($conn, "
    UPDATE peminjaman 
    SET status='Dikembalikan' 
    WHERE id_pinjam = $id
");

/* Tambah stok alat */
mysqli_query($conn, "
    UPDATE alat 
    SET jumlah = jumlah + ".$p['jumlah']." 
    WHERE id_alat = ".$p['id_alat']."
");

header("location:index.php");
