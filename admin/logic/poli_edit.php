<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../login.php");
    exit();
}
include '../../koneksi/koneksi.php';
include '../partials/header.php';


$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM jenis_poli WHERE id_poli='$id'"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_poli'];
    $kode = $_POST['kode_poli'];

    mysqli_query($conn, "UPDATE jenis_poli SET nama_poli='$nama', kode_poli='$kode' WHERE id_poli='$id'");
    header("Location: ../poli.php");
    exit();
}
?>

<div class="container-fluid">
  <h2 class="mb-4">Edit Poli</h2>
  <form method="POST">
    <div class="mb-3">
      <label>Nama Poli</label>
      <input type="text" name="nama_poli" class="form-control" value="<?= $data['nama_poli']; ?>" required>
    </div>
    <div class="mb-3">
      <label>Kode Poli</label>
      <input type="text" name="kode_poli" class="form-control" value="<?= $data['kode_poli']; ?>" maxlength="1" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="../poli.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?php include '../partials/footer.php'; ?>