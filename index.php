<?php
include "layout/header.php";
include "config/koneksi.php";

$id_user = $_SESSION['id_user'];

/* TOTAL ALAT */
$totalAlat = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM alat")
)['total'];

/* DIPINJAM */
$dipinjam = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM peminjaman WHERE status='Dipinjam'")
)['total'];

/* DIKEMBALIKAN */
$kembali = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) total FROM peminjaman WHERE status='Dikembalikan'")
)['total'];

/* TELAT (>7 HARI) */
$telat = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT COUNT(*) total 
        FROM peminjaman 
        WHERE status='Dipinjam'
        AND DATEDIFF(CURDATE(), tgl_pinjam) > 7
    ")
)['total'];

/* ALAT TERFAVORIT */
$top = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT a.nama_alat, SUM(p.jumlah) total
        FROM peminjaman p
        JOIN alat a ON p.id_alat = a.id_alat
        GROUP BY p.id_alat
        ORDER BY total DESC
        LIMIT 1
    ")
);

/* PEMINJAMAN AKTIF USER */
$userAktif = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT COUNT(*) total 
        FROM peminjaman 
        WHERE id_user = $id_user
        AND status='Dipinjam'
    ")
)['total'];
?>

<h3>📊 Dashboard</h3>
<p class="text-muted">
    Login sebagai <b><?= $_SESSION['username']; ?></b>
</p>

<!-- BARIS 1 -->
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card p-4 text-center">
            <h5>🔧 Total Alat</h5>
            <h1><?= $totalAlat ?></h1>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4 text-center">
            <h5>📋 Dipinjam</h5>
            <h1><?= $dipinjam ?></h1>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4 text-center">
            <h5>✅ Dikembalikan</h5>
            <h1><?= $kembali ?></h1>
        </div>
    </div>
</div>

<!-- BARIS 2 -->
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card p-4 text-center">
            <h5>⏱️ Peminjaman Telat</h5>
            <h1 class="text-danger"><?= $telat ?></h1>
            <small class="text-muted">Lebih dari 7 hari</small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4 text-center">
            <h5>🔥 Alat Terfavorit</h5>
            <b><?= $top['nama_alat'] ?? '-' ?></b><br>
            <small><?= $top['total'] ?? 0 ?> unit dipinjam</small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4 text-center">
            <h5>👤 Peminjaman Saya</h5>
            <h1><?= $userAktif ?></h1>
            <small class="text-muted">Masih dipinjam</small>
        </div>
    </div>
</div>

<?php include "layout/footer.php"; ?>
