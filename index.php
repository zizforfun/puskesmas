<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Sehat Bersama</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="style.css" rel="stylesheet" >
</head>
<body>

<!-- NAVBAR -->
<?php include "component/navbar.php"; ?>

<!-- HERO -->
<section class="hero d-flex align-items-center">
  <div class="container">
    <div class="col-lg-7">
      <h1 class="fw-bold text-white">Pelayanan Medis Terbaik Untuk Keluarga Anda</h1>
      <p class="lead text-light mt-3">Cepat, aman, nyaman dan terpercaya.</p>
      <a href="ambilantrian.php" class="btn btn-lg btn-warning fw-bold mt-4">Ambil Antrian</a>
    </div>
  </div>
</section>

<!-- LAYANAN -->
<section class="container text-center py-5">
  <h2 class="fw-bold text-success mb-4">Layanan Kami</h2>

  <div class="row g-4">
    <div class="col-md-4">
      <div class="service-card p-4 shadow-sm">
        <i class="bi bi-heart-pulse-fill service-icon text-success"></i>
        <h5 class="fw-bold mt-3">Pemeriksaan Umum</h5>
        <p>Penanganan keluhan umum oleh dokter profesional.</p>
      </div>
    </div>

    <div class="col-md-4">
    <div class="service-card p-4 shadow-sm">
        <i class="bi bi-tooth-fill text-success" style="font-size: 3rem;"></i>
         <!-- <i class="bi bi-alarm-fill text-success" style="font-size:3rem;"></i> -->

        <h5 class="fw-bold mt-3">Poli Gigi</h5>
        <p>Perawatan gigi lengkap dan tanpa rasa sakit.</p>
    </div>
    </div>

    <div class="col-md-4">
      <div class="service-card p-4 shadow-sm">
        <i class="bi bi-emoji-smile-fill service-icon text-success"></i>
        <h5 class="fw-bold mt-3">Poli Anak</h5>
        <p>Konsultasi khusus anak dengan lingkungan ramah.</p>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="footer text-center text-white pt-4">
  <p class="fw-bold mb-1">Klinik Sehat Bersama</p>
  <small>Jl. Kesehatan No. 123 - Yogyakarta</small><br>
  <small>Telp/WA: 0812-3456-7890</small>
  <div class="mt-3 p-2 bg-dark text-white">
    <small>© 2025 Semua Hak Dilindungi.</small>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>