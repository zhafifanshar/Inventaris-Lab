<?php
include "../layout/header.php";
include "../config/koneksi.php";

$id_user = $_SESSION['id_user'];

$data = mysqli_query($conn, "
    SELECT p.*, a.nama_alat
    FROM peminjaman p
    JOIN alat a ON p.id_alat = a.id_alat
    WHERE p.id_user = $id_user
    ORDER BY p.tgl_pinjam DESC
");
?>

<h3 class="mb-4">📋 Peminjaman Saya</h3>

<div class="card p-4">
    <div class="table-wrapper">
        <table class="table table-hover align-middle text-nowrap">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Alat</th>
                    <th>Jumlah</th>
                    <th>Tgl Pinjam</th>
                    <th>Lama</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

<?php
$no = 1;
while ($d = mysqli_fetch_assoc($data)) {

    $tgl_pinjam = new DateTime($d['tgl_pinjam']);
    $hari_ini   = new DateTime();
    $lama       = $tgl_pinjam->diff($hari_ini)->days;
?>
                <tr>
                    <td><?= $no++ ?></td>

                    <td class="fw-semibold">
                        <?= $d['nama_alat'] ?>
                    </td>

                    <td>
                        <span class="badge bg-primary">
                            <?= $d['jumlah'] ?> unit
                        </span>
                    </td>

                    <td>
                        <?= date('d-m-Y', strtotime($d['tgl_pinjam'])) ?>
                    </td>

                    <td>
                        <?php if ($d['status'] == 'Dipinjam') { ?>
                            <?= $lama ?> hari
                        <?php } else { ?>
                            -
                        <?php } ?>
                    </td>

                    <td>
                        <?php if ($d['status'] == 'Dipinjam') { ?>
                            <?php if ($lama > 7) { ?>
                                <span class="badge bg-danger">
                                    Telat <?= $lama - 7 ?> hari
                                </span>
                            <?php } else { ?>
                                <span class="badge bg-warning">
                                    Dipinjam
                                </span>
                            <?php } ?>
                        <?php } else { ?>
                            <span class="badge bg-success">
                                Dikembalikan
                            </span>
                        <?php } ?>
                    </td>

                    <td>
                        <?php if ($d['status'] == 'Dipinjam') { ?>
                            <a href="kembali.php?id=<?= $d['id_pinjam'] ?>"
                               class="btn btn-success btn-sm"
                               onclick="return confirm('Kembalikan alat ini?')">
                               Kembalikan
                            </a>
                        <?php } else { ?>
                            <span class="text-muted">Selesai</span>
                        <?php } ?>
                    </td>
                </tr>
<?php } ?>

            </tbody>
        </table>
    </div>
</div>

<?php include "../layout/footer.php"; ?>
