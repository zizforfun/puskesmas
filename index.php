<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Klinik Sehat Bersama</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

</head>
<?php include 'component/navbar.php'; ?>
<body>

<!-- Hero Section dengan Ilustrasi -->
<section class="landing d-flex align-items-center">
  <div class="container p-5">
    <div class="row">
      <!-- Kiri: Teks dan Tombol -->
      <div class="col-md-6 d-flex flex-column justify-content-center">
        <h1 class="fw-bold text-success mb-3">Kami Peduli Kesehatan Anda</h1>
        <p class="text-muted mb-4">Layanan antrian cepat, akurat, dan ramah pasien</p>
        <div class="d-flex gap-3">
          <a href="ambilantrian.php" class="btn btn-success px-4">Ambil Antrian</a>
          <a href="antrian.php" class="btn btn-primary px-4">Cek Antrian</a>
        </div>
      </div>

      <!-- Kanan: Gambar dan Shape -->
      <div class="col-md-6 position-relative text-center">
        <div class=""></div>
        <img src="gambar/Gemini_Generated_Image_frrdknfrrdknfrrd-removebg-preview.png" alt="Ilustrasi Dokter" class="gambar-dokter" style="max-height: 1000px; z-index: 2;">
      </div>
    </div>
  </div>
</section>

<!-- Info Poli dengan Bootstrap Icons -->
<section class="features py-5 bg-white">
  <div class="container">
    <h3 class="text-center fw-bold text-success mb-5">Layanan Poli Kami</h3>

    <div class="row text-center">

      <!-- Poli Anak -->
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0 p-4">
          <div class="icon-wrapper bg-danger bg-opacity-10 text-danger mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width:90px; height:90px; margin:auto;">
          <i class="bi bi-emoji-smile fs-1"></i>
          </div>
          <h5 class="fw-bold">Poli Anak</h5>
          <p class="text-muted">Konsultasi dan pemeriksaan kesehatan khusus anak-anak.</p>
        </div>
      </div>

     <!-- Poli Gigi -->
     <div class="col-md-4 mb-4">
       <div class="card h-100 shadow-sm border-0 p-4">
         <div class="icon-wrapper bg-warning bg-opacity-25 text-warning mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width:90px; height:90px; margin:auto;">
           <i class="bi bi-shield-check fs-1"></i>
         </div>
         <h5 class="fw-bold">Poli Gigi</h5>
         <p class="text-muted">Perawatan kesehatan gigi dan mulut oleh tenaga ahli.</p>
        </div>
     </div>

      <!-- Poli Umum -->
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0 p-4">
          <div class="icon-wrapper bg-info bg-opacity-10 text-info mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width:90px; height:90px; margin:auto;">
            <i class="bi bi-person-heart fs-1"></i>
          </div>
          <h5 class="fw-bold">Poli Umum</h5>
          <p class="text-muted">Pelayanan kesehatan umum untuk semua usia dengan tenaga medis profesional </p>
        </div>
      </div>

    </div>
  </div>
</section>


<section class="cta text-white py-5">
  <div class="container text-center">
    <h4 class="fw-bold mb-2">Butuh Bantuan Darurat?</h4>
    <p class="mb-3">Hubungi layanan cepat tanggap kami 24 jam</p>
    <h2 class="fw-bold">0812-3456-7890</h2>
    <p class="mt-3">Kami siap membantu Anda kapan saja</p>
  </div>
</section>

<!-- Lokasi Klinik -->
<section class="py-5 bg-light">
  <div class="container">
    <h3 class="fw-bold text-success text-center mb-4">Lokasi Klinik Kami</h3>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm border-0">
          <div class="card-body p-0">
            <iframe 
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.7251134610294!2d118.723896!3d-8.456547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2db46d4fbe9a6a8b%3A0xf3e8e61e94d3b4d4!2sBima%2C%20Nusa%20Tenggara%20Barat!5e0!3m2!1sid!2sid!4v1700000000000"
              width="100%" height="350" style="border:0; border-radius:12px;"
              allowfullscreen="" loading="lazy">
            </iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>





<?php include 'component/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>