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
$query = "SELECT a.id_antrian, a.no_antrian, a.status, a.tanggal_kunjungan, p.nama_lengkap, j.nama_poli
  FROM antrian a
  JOIN pasien p ON a.id_pasien = p.id_pasien
  JOIN jenis_poli j ON a.id_poli = j.id_poli
  ORDER BY a.tanggal_kunjungan DESC, a.no_antrian ASC
";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Antrian</title>
      <link href="assets/style.css" rel="stylesheet">
</head>
<body>
  


<div class="container-fluid">
  <h2 class="mb-4">Data Antrian</h2>
  <table class="table table-bordered table-striped">
    <thead class="table-success">
      <tr>
        <th>No</th>
        <th>Nama Pasien</th>
        <th>Poli</th>
        <th>No Antrian</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; while($row = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama_lengkap']; ?></td>
        <td><?= $row['nama_poli']; ?></td>
        <td><?= $row['no_antrian']; ?></td>
        <td><?= $row['tanggal_kunjungan']; ?></td>
        <td>
          <span class="badge 
            <?= $row['status']=='menunggu'?'bg-warning':
                ($row['status']=='selesai'?'bg-success':'bg-danger'); ?>">
            <?= $row['status']; ?>
          </span>
        </td>
        <td>
          <?php if($row['status']=='menunggu'): ?>
            <?php if($row['nama_poli']=='Umum'): ?>
              <a href="/logic/antrian_update.php?id=<?= $row['id_antrian']; ?>&status=selesai" 
                 class="btn btn-primary btn-sm">Panggil Umum</a>
            <?php elseif($row['nama_poli']=='Gigi'): ?>
              <a href="logic/antrian_update.php?id=<?= $row['id_antrian']; ?>&status=selesai" 
                 class="btn btn-danger btn-sm">Panggil Gigi</a>
            <?php elseif($row['nama_poli']=='Anak'): ?>
              <a href="logic/antrian_update.php?id=<?= $row['id_antrian']; ?>&status=selesai" 
                 class="btn btn-success btn-sm">Panggil Anak</a>
            <?php endif; ?>
          <?php else: ?>
            <em>-</em>
          <?php endif; ?>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>

<?php include 'partials/footer.php'; ?>