<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../login.php");
    exit();
}
include '../../koneksi/koneksi.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_poli'];
    $kode = $_POST['kode_poli'];

    mysqli_query($conn, "INSERT INTO jenis_poli(nama_poli,kode_poli) VALUES('$nama','$kode')");
    header("Location: poli.php");
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
      <h2 class="mb-4" style="text-align : center">Tambah Poli</h2>
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
  </div>
</body>
</html>

<?php include '../partials/footer.php'; ?>