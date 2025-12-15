<?php
include "../layout/header.php";
include "../config/koneksi.php";

$data = mysqli_query($conn, "SELECT * FROM alat ORDER BY nama_alat ASC");
?>

<h3 class="mb-4">🔧 Data Alat Laboratorium</h3>

<div class="card p-4">
<table class="table table-hover align-middle text-nowrap">
    <thead class="table-light">
        <tr>
            <th style="width:60px; text-align:center;">No</th>
            <th>Nama Alat</th>
            <th style="width:120px; text-align:center;">Stok</th>
            <th style="width:120px; text-align:center;">Kondisi</th>
            <th style="width:200px; text-align:center;">Pinjam</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; while($d=mysqli_fetch_assoc($data)){ ?>
        <tr>
            <td style="text-align:center;"><?= $no++ ?></td>
            <td><?= $d['nama_alat'] ?></td>

            <!-- STOK + PERINGATAN -->
            <td style="text-align:center;">
                <?php if ($d['jumlah'] == 0) { ?>
                    <span class="badge bg-secondary">Habis</span>
                <?php } elseif ($d['jumlah'] <= 5) { ?>
                    <span class="badge bg-danger">
                        ⚠ <?= $d['jumlah'] ?> unit
                    </span>
                <?php } else { ?>
                    <span class="badge bg-primary">
                        <?= $d['jumlah'] ?> unit
                    </span>
                <?php } ?>
            </td>

            <td style="text-align:center;">
                <span class="badge bg-success"><?= $d['kondisi'] ?></span>
            </td>

            <!-- PINJAM -->
            <td style="text-align:center;">
                <?php if ($d['jumlah'] > 0) { ?>
                <form action="pinjam.php" method="post" 
                      class="d-flex justify-content-center gap-2">
                    <input type="hidden" name="id_alat" value="<?= $d['id_alat'] ?>">
                    <input type="number" 
                           name="jumlah" 
                           min="1" 
                           max="<?= $d['jumlah'] ?>" 
                           class="form-control form-control-sm"
                           style="width:80px;"
                           required>
                    <button class="btn btn-warning btn-sm">
                        Pinjam
                    </button>
                </form>
                <?php } else { ?>
                    <span class="badge bg-secondary">Tidak tersedia</span>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>

<?php include "../layout/footer.php"; ?>
