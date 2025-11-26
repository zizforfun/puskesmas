<?php
include 'koneksi/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ambil Antrian</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

  <style>
    html, body { height: 100%; }
    .page-wrapper {
        min-height: 100%;
        display: flex;
        flex-direction: column;
    }
    .content { flex: 1; }
  </style>
</head>

<body>

<div class="page-wrapper">

<?php include 'component/navbar.php'; ?>

<div class="container-fluid mt-5 pt-4 content">

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nik = $_POST['nik'];
    $cek = mysqli_query($conn, "SELECT * FROM pasien WHERE NIK='$nik'");

    if (mysqli_num_rows($cek) > 0) {
        $pasien = mysqli_fetch_assoc($cek);
        $id_pasien = $pasien['id_pasien'];
?>

        <!-- JUDUL -->
        <h2 class="fw-bold mb-4 text-success d-flex align-items-center">
            <i class="bi bi-clipboard2-pulse-fill me-2"></i>
            Ambil Antrian
        </h2>

        <!-- CARD UTAMA -->
        <div class="card border-0 shadow-lg rounded-4 mb-4">
            <div class="card-body p-4">

                <div class="d-flex align-items-center mb-3">
                    <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3 shadow-sm">
                        <i class="bi bi-person-check-fill text-success fs-3"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 text-capitalize"><?= $pasien['nama_lengkap']; ?></h4>
                        <small class="text-muted">NIK: <?= $pasien['NIK']; ?></small>
                    </div>
                </div>

                <hr>

                <form method="POST" action="logic/ambil_antrian.php">

                    <input type="hidden" name="id_pasien" value="<?= $id_pasien; ?>">

                    <!-- PILIH POLI -->
                    <label class="form-label fw-semibold mb-2">
                        <i class="bi bi-hospital-fill me-1 text-success"></i> Pilih Poli
                    </label>

                    <select name="id_poli" class="form-select form-select-lg rounded-3 shadow-sm mb-4" required>
                        <?php
                        $poli = mysqli_query($conn, "SELECT * FROM jenis_poli");
                        while ($row = mysqli_fetch_assoc($poli)) {
                            echo "<option value='{$row['id_poli']}'>{$row['nama_poli']}</option>";
                        }
                        ?>
                    </select>

                    <button type="submit" class="btn btn-success btn-lg rounded-pill px-4 d-inline-flex align-items-center shadow-sm">
                        <i class="bi bi-check2-circle me-2"></i>
                        Ambil Antrian
                    </button>

                </form>

            </div>
        </div>

        <!-- INFO -->
        <div class="alert alert-success d-flex align-items-center rounded-4 shadow-sm mt-3">
            <i class="bi bi-info-circle-fill fs-4 me-3"></i>
            <div>
                <strong>Pastikan data sudah benar.</strong><br>
                Setelah mengambil antrian, Anda akan diarahkan ke halaman detail antrian.
            </div>
        </div>

        <a href="ambilantrian.php" 
           class="btn btn-outline-success rounded-pill px-3 mb-4 d-inline-flex align-items-center shadow-sm">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>

<?php
    } else {
        echo "
        <div class='alert alert-warning d-flex align-items-center p-4 rounded-4 shadow-sm mt-4'>
          <i class='bi bi-exclamation-triangle-fill fs-3 me-3 text-warning'></i>
          <div>
            <h5 class='fw-bold mb-1'>NIK Tidak Ditemukan</h5>
            <p class='mb-0'>Silakan registrasi pasien baru untuk melanjutkan.</p>
          </div>
        </div>

        <a href='pasien_add.php'
           class='btn btn-primary btn-lg mt-3 rounded-pill px-4 shadow-sm d-inline-flex align-items-center'>
          <i class='bi bi-person-plus-fill me-2'></i>
          Registrasi Pasien Baru
        </a>";
    }

} else {

?>

<div class="container py-5">

  <div class="text-center mb-4">
    <h2 class="fw-bold text-success">
      <i class="bi bi-search-heart me-2"></i>
      Cek NIK Pasien
    </h2>
    <p class="text-muted">Masukkan NIK Anda untuk melanjutkan proses antrian.</p>
  </div>

  <div class="card border-0 shadow-lg rounded-4">
    <div class="card-body p-4">

      <form method="POST">

        <div class="mb-4">
          <label class="form-label fw-semibold">
            <i class="bi bi-credit-card-2-front-fill me-1 text-success"></i>
            Nomor Induk Kependudukan (NIK)
          </label>

          <input 
            type="text"
            name="nik"
            class="form-control form-control-lg rounded-3 shadow-sm"
            placeholder="Masukkan NIK Anda..."
            required
          >
        </div>

        <button type="submit" class="btn btn-success btn-lg rounded-pill px-4 shadow-sm d-flex align-items-center">
          <i class="bi bi-search me-2"></i>
          Cek NIK
        </button>

      </form>

    </div>
  </div>

</div>

<?php
}
?>

</div>

<?php include 'component/footer.php'; ?>

</div>

</body>
</html>
