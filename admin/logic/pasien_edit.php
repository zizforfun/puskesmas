<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../login.php");
    exit();
}
include '../../koneksi/koneksi.php';
include '../partials/header.php';
include '../partials/sidebar.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pasien WHERE id_pasien='$id'"));

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

    mysqli_query($conn, "UPDATE pasien SET 
        no_pasien='$no_pasien',
        NIK='$nik',
        nama_lengkap='$nama',
        tanggal_lahir='$tgl',
        Jenis_Kelamin='$jk',
        umur='$umur',
        alamat='$alamat',
        status_pernikahan='$status',
        no_hp='$hp'
        WHERE id_pasien='$id'");

    header("Location: pasien.php");
    exit();
}
?>

<div class="container-fluid">
  <h2 class="mb-4">Edit Pasien</h2>
  <form method="POST">
    <div class="mb-3">
      <label>No Pasien</label>
      <input type="text" name="no_pasien" class="form-control" value="<?= $data['no_pasien']; ?>" required>
    </div>
    <div class="mb-3">
      <label>NIK</label>
      <input type="text" name="nik" class="form-control" value="<?= $data['NIK']; ?>" required>
    </div>
    <div class="mb-3">
      <label>Nama Lengkap</label>
      <input type="text" name="nama" class="form-control" value="<?= $data['nama_lengkap']; ?>" required>
    </div>
    <div class="mb-3">
      <label>Tanggal Lahir</label>
      <input type="date" name="tanggal_lahir" class="form-control" value="<?= $data['tanggal_lahir']; ?>" required>
    </div>
    <div class="mb-3">
      <label>Jenis Kelamin</label>
      <select name="jenis_kelamin" class="form-control">
        <option value="Laki-laki" <?= $data['Jenis_Kelamin']=='Laki-laki'?'selected':''; ?>>Laki-laki</option>
        <option value="Perempuan" <?= $data['Jenis_Kelamin']=='Perempuan'?'selected':''; ?>>Perempuan</option>
      </select>
    </div>
    <div class="mb-3">
      <label>Umur</label>
      <input type="number" name="umur" class="form-control" value="<?= $data['umur']; ?>" required>
    </div>
    <div class="mb-3">
      <label>Alamat</label>
      <textarea name="alamat" class="form-control" required><?= $data['alamat']; ?></textarea>
    </div>
    <div class="mb-3">
      <label>Status Pernikahan</label>
      <select name="status" class="form-control">
        <option value="Belum Menikah" <?= $data['status_pernikahan']=='Belum Menikah'?'selected':''; ?>>Belum Menikah</option>
        <option value="Menikah" <?= $data['status_pernikahan']=='Menikah'?'selected':''; ?>>Menikah</option>
        <option value="Cerai" <?= $data['status_pernikahan']=='Cerai'?'selected':''; ?>>Cerai</option>
      </select>
    </div>
    <div class="mb-3">
      <label>No HP</label>
      <input type="text" name="no_hp" class="form-control" value="<?= $data['no_hp']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="../pasien.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?php include '../partials/footer.php'; ?>