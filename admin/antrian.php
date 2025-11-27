<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../login.php");
    exit();
}

include '../koneksi/koneksi.php';
include 'partials/header.php';
include 'partials/sidebar.php';

// Ambil data antrian join pasien + poli
$query = "SELECT a.id_antrian, a.no_antrian, a.status, a.tanggal_kunjungan, 
                 p.nama_lengkap, j.nama_poli
          FROM antrian a
          JOIN pasien p ON a.id_pasien = p.id_pasien
          JOIN jenis_poli j ON a.id_poli = j.id_poli
          ORDER BY j.nama_poli ASC, a.tanggal_kunjungan DESC, a.no_antrian ASC";
$result = mysqli_query($conn, $query);

// Susun array per poli
$antrian = [];
while ($row = mysqli_fetch_assoc($result)) {
    $antrian[$row['nama_poli']][] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Antrian</title>
  <link href="assets/style.css" rel="stylesheet">

  <style>
      .icon-btn {
          padding: 5px 10px;
          font-size: 18px;
          border-radius: 6px;
      }
  </style>
</head>
<body>

<div class="container-fluid">
  <h2 class="mb-4">Data Antrian</h2>

  <?php foreach ($antrian as $poli => $list): ?>
    <?php 
      $total = count($list); 
      $menunggu = count(array_filter($list, fn($row) => $row['status'] === 'menunggu'));
      $selesai  = count(array_filter($list, fn($row) => $row['status'] === 'selesai'));
      $batal    = count(array_filter($list, fn($row) => $row['status'] === 'batal'));
    ?>
    <div class="card mb-4 shadow-sm">
      <div class="card-header bg-success text-white fw-bold d-flex justify-content-between align-items-center">
        <span><?= htmlspecialchars($poli); ?></span>
        <span class="badge bg-light text-dark">
          Total: <?= $total ?> | Menunggu: <?= $menunggu ?> | Selesai: <?= $selesai ?>
        </span>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <thead class="table-light">
            <tr>
              <th>No</th>
              <th>Nama Pasien</th>
              <th>No Antrian</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach($list as $row): ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama_lengkap']; ?></td>
                <td><?= $row['no_antrian']; ?></td>
                <td><?= $row['tanggal_kunjungan']; ?></td>
                <td>
                  <span class="badge 
                    <?= $row['status']=='menunggu'?'bg-warning':
                        ($row['status']=='selesai'?'bg-success':'bg-danger'); ?>">
                    <?= $row['status']; ?>
                  </span>
                </td>
                <td class="text-center">
                  <?php if($row['status'] == 'menunggu'): ?>
                    <a href="logic/antrian_update.php?id=<?= $row['id_antrian']; ?>&status=selesai"
                       class="btn btn-sm btn-success icon-btn" title="Selesaikan Antrian">✔️</a>
                  <?php else: ?>
                    <a href="logic/antrian_update.php?id=<?= $row['id_antrian']; ?>&status=menunggu"
                       class="btn btn-sm btn-warning icon-btn" title="Batalkan ke Menunggu">↩️</a>
                  <?php endif; ?>

                  <a href="logic/antrian_delete.php?id=<?= $row['id_antrian']; ?>"
                       onclick="return confirm('Yakin ingin menghapus antrian ini?')"
                       class="btn btn-sm btn-danger icon-btn" title="Hapus Antrian">🗑️</a>

                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php endforeach; ?>
</div>
</body>
</html>

<?php include 'partials/footer.php'; ?>
