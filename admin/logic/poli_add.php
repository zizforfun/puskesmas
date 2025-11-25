<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../login.php");
    exit();
}
include '../../koneksi/koneksi.php';
include '../partials/header.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_poli'];
    $kode = $_POST['kode_poli'];

    mysqli_query($conn, "INSERT INTO jenis_poli(nama_poli,kode_poli) VALUES('$nama','$kode')");
    header("Location: poli.php");
    exit();
}
?>

<div class="container-fluid">
  <h2 class="mb-4">Tambah Poli</h2>
  <form method="POST">
    <div class="mb-3">
      <label>Nama Poli</label>
      <input type="text" name="nama_poli" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Kode Poli</label>
      <input type="text" name="kode_poli" class="form-control" maxlength="1" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="../poli.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?php include '../partials/footer.php'; ?>