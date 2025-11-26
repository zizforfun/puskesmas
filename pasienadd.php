<?php
include 'koneksi/koneksi.php';

// Proses simpan pasien
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $no_pasien = $_POST['no_pasien'];
    $NIK = $_POST['NIK'];
    $nama = $_POST['nama_lengkap'];
    $tgl = $_POST['tanggal_lahir'];
    $poli = $_POST['poli'];
    $jk = $_POST['Jenis_Kelamin'];
    $umur = $_POST['umur'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status_pernikahan'];
    $hp = $_POST['no_hp'];

    $query = "INSERT INTO pasien (no_pasien, NIK, nama_lengkap, tanggal_lahir, poli, Jenis_Kelamin, umur, alamat, status_pernikahan, no_hp)
              VALUES ('$no_pasien', '$NIK', '$nama', '$tgl', '$poli', '$jk', '$umur', '$alamat', '$status', '$hp')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data pasien berhasil ditambahkan!'); window.location='ambilantrian.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi Pasien Baru</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>

<?php include 'component/navbar.php'; ?>

<div class="container py-5">
  <h2 class="fw-bold mb-4 text-success">Registrasi Pasien Baru</h2>

  <div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">

      <form method="POST">

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Nomor Pasien</label>
            <input type="text" name="no_pasien" class="form-control" required>
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label">NIK</label>
            <input type="text" name="NIK" class="form-control" required>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" name="nama_lengkap" class="form-control" required>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" required>
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label">Umur</label>
            <input type="number" name="umur" class="form-control" required>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Pilih Poli</label>
          <select name="poli" class="form-control" required>
            <option value="">-- Pilih Poli --</option>
            <option value="Umum">Umum</option>
            <option value="Anak">Anak</option>
            <option value="Gigi">Gigi</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Jenis Kelamin</label>
          <select name="Jenis_Kelamin" class="form-control" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Alamat</label>
          <textarea name="alamat" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Status Pernikahan</label>
          <select name="status_pernikahan" class="form-control" required>
            <option value="Belum Menikah">Belum Menikah</option>
            <option value="Menikah">Menikah</option>
            <option value="Cerai">Cerai</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Nomor HP</label>
          <input type="text" name="no_hp" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success px-4">Simpan</button>

      </form>

    </div>
  </div>
</div>

<?php include 'component/footer.php'; ?>

</body>
</html>
