<?php
include "../layout/header.php";
include "../config/koneksi.php";

$id_user = $_SESSION['id_user'];

/* ======================
   UPDATE PROFIL
====================== */
if (isset($_POST['update'])) {
    $nama  = mysqli_real_escape_string($conn, $_POST['nama']);
    $prodi = mysqli_real_escape_string($conn, $_POST['prodi']);

    mysqli_query($conn,"
        UPDATE users SET
        nama='$nama',
        prodi='$prodi'
        WHERE id=$id_user
    ");

    $_SESSION['nama']  = $nama;
    $_SESSION['prodi'] = $prodi;

    echo "<script>alert('Profil berhasil diperbarui');location='profil.php';</script>";
}

/* ======================
   DATA USER
====================== */
$user = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT * FROM users WHERE id=$id_user")
);

/* ======================
   RIWAYAT PINJAM
====================== */
$riwayat = mysqli_query($conn,"
    SELECT p.*, a.nama_alat
    FROM peminjaman p
    JOIN alat a ON p.id_alat = a.id_alat
    WHERE p.id_user=$id_user
    ORDER BY p.tgl_pinjam DESC
");
?>

<h3 class="mb-4">👤 Profil Saya</h3>

<div class="row">

<!-- ================= PROFIL CARD ================= -->
<div class="col-md-4">
    <div class="card p-4 text-center">
        <div class="avatar mb-3"
             style="width:80px;height:80px;border-radius:50%;
             background:#eaeaff;display:flex;align-items:center;
             justify-content:center;font-size:32px;font-weight:700;margin:auto;">
            <?= strtoupper(substr($user['nama'] ?? $user['username'],0,1)) ?>
        </div>

        <h5 class="mb-1">
            <?= $user['nama'] ?? '-' ?>
        </h5>
        <div class="text-muted mb-3">
            <?= $user['prodi'] ?? '-' ?>
        </div>

        <span class="badge bg-primary">
            <?= $user['username'] ?>
        </span>
    </div>
</div>

<!-- ================= FORM EDIT ================= -->
<div class="col-md-8">
    <div class="card p-4 mb-4">
        <h5 class="mb-3">✏️ Edit Profil</h5>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text"
                       name="nama"
                       class="form-control"
                       value="<?= $user['nama'] ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Program Studi</label>
                <input type="text"
                       name="prodi"
                       class="form-control"
                       value="<?= $user['prodi'] ?>">
            </div>

            <button name="update" class="btn btn-primary">
                💾 Simpan Perubahan
            </button>
        </form>
    </div>
</div>

</div>

<!-- ================= RIWAYAT ================= -->
<div class="card p-4">
    <h5 class="mb-3">📜 Riwayat Peminjaman</h5>

    <div class="table-wrapper">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Alat</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

<?php
$no=1;
while($r=mysqli_fetch_assoc($riwayat)){
?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td class="fw-semibold"><?= $r['nama_alat'] ?></td>
                    <td><?= date('d-m-Y',strtotime($r['tgl_pinjam'])) ?></td>
                    <td>
                        <?php if($r['status']=='Dipinjam'){ ?>
                            <span class="badge bg-warning">Dipinjam</span>
                        <?php } else { ?>
                            <span class="badge bg-success">Dikembalikan</span>
                        <?php } ?>
                    </td>
                </tr>
<?php } ?>

            </tbody>
        </table>
    </div>
</div>

<?php include "../layout/footer.php"; ?>
