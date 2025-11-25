<?php
// dashboard.php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../login.php");
    exit();
}

include '../koneksi/koneksi.php'; // file koneksi database
include 'partials/header.php';
include 'partials/sidebar.php';

// Query statistik
$jumlahPasien = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM pasien"))['total'];
$jumlahAntrianHariIni = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM antrian WHERE tanggal_kunjungan = CURDATE()"))['total'];
$jumlahPoli = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM jenis_poli"))['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
     <link href="assets/style.css" rel="stylesheet">
</head>
<body>
    
    <div class="container-fluid py-4">
        <h2 class="mb-4">Dashboard Admin</h2>
        <div class="row g-4">
    <div class="col-md-4">
        <div class="card shadow-sm border-success">
            <div class="card-body text-center">
                <h6 class="text-muted">Total Pasien</h6>
                <h3 class="fw-bold text-success"><?= $jumlahPasien; ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm border-primary">
          <div class="card-body text-center">
              <h6 class="text-muted">Antrian Hari Ini</h6>
              <h3 class="fw-bold text-primary"><?= $jumlahAntrianHariIni; ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-info">
            <div class="card-body text-center">
                <h6 class="text-muted">Jumlah Poli</h6>
                <h3 class="fw-bold text-info"><?= $jumlahPoli; ?></h3>
            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>
<?php include '../component/footer.php'; ?>