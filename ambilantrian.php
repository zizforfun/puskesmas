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

  <!-- Tambahkan CSS supaya footer tetap di bawah -->
  <style>
    html, body {
      height: 100%;
    }
    .page-wrapper {
      min-height: 100%;
      display: flex;
      flex-direction: column;
    }
    .content {
      flex: 1;
    }
  </style>
</head>

<body>

<div class="page-wrapper"> <!-- WRAPPER MULAI -->

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

    <h2 class="mb-4">Ambil Antrian</h2>
    <p>Halo, <strong><?= $pasien['nama_lengkap']; ?></strong> (NIK: <?= $pasien['NIK']; ?>)</p>

    <form method="POST" action="logic/ambil_antrian.php" class="p-4 bg-white rounded shadow">
        <input type="hidden" name="id_pasien" value="<?= $id_pasien; ?>">

        <div class="mb-3">
            <label class="form-label">Pilih Poli</label>
            <select name="id_poli" class="form-control" required>
                <?php
                $poli = mysqli_query($conn, "SELECT * FROM jenis_poli");
                while($row = mysqli_fetch_assoc($poli)){
                    echo "<option value='{$row['id_poli']}'>{$row['nama_poli']}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Ambil Antrian</button>
    </form>

<?php
    } else {
        echo "<div class='alert alert-warning mt-4'>NIK tidak ditemukan. Silakan registrasi pasien baru.</div>";
        echo "<a href='pasien_add.php' class='btn btn-primary mt-2'>Registrasi Pasien Baru</a>";
    }

} else {
?>

<div class="container py-5">
  <h2 class="fw-bold mb-4 text-success">Cek NIK Pasien</h2>

  <div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">

      <form method="POST">
        <div class="mb-3">
          <label class="form-label fw-semibold">Masukkan NIK</label>
          <input 
            type="text" 
            name="nik" 
            class="form-control form-control-lg" 
            placeholder="Masukkan NIK Anda..."
            required
          >
        </div>

        <button type="submit" class="btn btn-success btn-lg px-4">
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
