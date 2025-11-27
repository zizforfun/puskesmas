<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../login.php");
    exit();
}
include '../../koneksi/koneksi.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_pasien = $_POST['no_pasien'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $tgl = $_POST['tanggal_lahir'];
    $jk = $_POST['jenis_kelamin'];
    $umur = $_POST['umur'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];
    $hp = $_POST['no_hp'];

    mysqli_query($conn, "INSERT INTO pasien(no_pasien,NIK,nama_lengkap,tanggal_lahir,Jenis_Kelamin,umur,alamat,status_pernikahan,no_hp) 
                         VALUES('$no_pasien','$nik','$nama','$tgl','$jk','$umur','$alamat','$status','$hp')");
    header("Location: pasien.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="../../css/style.css" rel="stylesheet">
</head>
<body>
  
  <div class="container p-5">

    <div class="container-fluid">
      <h2 class="mb-4" style="text-align: center";>Tambah Pasien</h2>
      <form method="POST">
        <div class="mb-3">
          <label>No Pasien</label>
          <input type="text" name="no_pasien" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>NIK</label>
          <input type="text" name="nik" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Nama Lengkap</label>
          <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Tanggal Lahir</label>
          <input type="date" name="tanggal_lahir" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Jenis Kelamin</label>
          <select name="jenis_kelamin" class="form-control">
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>
        <div class="mb-3">
          <label>Umur</label>
          <input type="number" name="umur" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Alamat</label>
          <textarea name="alamat" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
          <label>Status Pernikahan</label>
          <select name="status" class="form-control">
            <option value="Belum Menikah">Belum Menikah</option>
            <option value="Menikah">Menikah</option>
            <option value="Cerai">Cerai</option>
          </select>
        </div>
        <div class="mb-3">
          <label>No HP</label>
          <input type="text" name="no_hp" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="../pasien.php" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
    
  </body>
  </html>
  <?php include '../partials/footer.php'; ?>