<?php
include "../layout/header.php";
include "../config/koneksi.php";

$id = $_GET['id'];

// DATA PROFIL
$profil = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT * FROM peminjam WHERE id_peminjam = $id
"));

// TANGGAL PERTAMA PINJAM
$pertama = mysqli_fetch_assoc(mysqli_query($conn,"
    SELECT MIN(tgl_pinjam) tgl FROM peminjaman WHERE id_peminjam = $id
"))['tgl'];

// RIWAYAT PEMINJAMAN
$riwayat = mysqli_query($conn,"
    SELECT peminjaman.*, alat.nama_alat 
    FROM peminjaman 
    JOIN alat ON peminjaman.id_alat = alat.id_alat
    WHERE peminjaman.id_peminjam = $id
    ORDER BY tgl_pinjam DESC
");
?>

<h3 class="mb-4">👤 Profil Peminjam</h3>

<div class="row">

<div class="col-md-4">
    <div class="card p-4">
        <h5><?= $profil['nama'] ?></h5>
        <p class="mb-1"><b>Prodi:</b> <?= $profil['prodi'] ?></p>
        <p class="mb-0"><b>Mulai meminjam:</b><br><?= $pertama ?></p>
    </div>
</div>

<div class="col-md-8">
    <div class="card p-4">
        <h5 class="mb-3">📜 Riwayat Peminjaman</h5>
        <table class="table table-hover">
            <tr>
                <th>No</th>
                <th>Alat</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
            <?php $no=1; while($r=mysqli_fetch_assoc($riwayat)){ ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $r['nama_alat'] ?></td>
                <td><?= $r['tgl_pinjam'] ?></td>
                <td>
                    <?php if($r['status']=='Dipinjam'){ ?>
                        <span class="badge bg-warning">Dipinjam</span>
                    <?php } else { ?>
                        <span class="badge bg-success">Dikembalikan</span>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

</div>

<?php include "../layout/footer.php"; ?>
