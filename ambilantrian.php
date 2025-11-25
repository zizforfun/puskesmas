<?php
include 'koneksi/koneksi.php';
include 'component/navbar.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nik = $_POST['nik'];

    // cek pasien berdasarkan NIK
    $cek = mysqli_query($conn, "SELECT * FROM pasien WHERE NIK='$nik'");
    if (mysqli_num_rows($cek) > 0) {
        $pasien = mysqli_fetch_assoc($cek);
        // pasien ditemukan, tampilkan form pilih poli
        $id_pasien = $pasien['id_pasien'];
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  
</head>
<body>
  
  <div class="container-fluid">
    <h2 class="mb-4">Ambil Antrian</h2>
    <p>Halo, <strong><?= $pasien['nama_lengkap']; ?></strong> (NIK: <?= $pasien['NIK']; ?>)</p>
          <form method="POST" action="logic/ambil_antrian.php">
            <input type="hidden" name="id_pasien" value="<?= $id_pasien; ?>">
            <div class="mb-3">
              <label>Pilih Poli</label>
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
        </div>
        <?php
    } else {
      // pasien tidak ditemukan, arahkan ke form registrasi
      echo "<div class='alert alert-warning'>NIK tidak ditemukan. Silakan registrasi pasien baru.</div>";
      echo "<a href='pasien_add.php' class='btn btn-primary'>Registrasi Pasien Baru</a>";
    }
  } else {
    ?>
<div class="container-fluid">
  <h2 class="mb-4">Cek NIK Pasien</h2>
  <form method="POST">
    <div class="mb-3">
      <label>Masukkan NIK</label>
      <input type="text" name="nik" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Cek NIK</button>
  </form>
</div>
</html>
</body>
<?php
}
include 'component/footer.php';
?>