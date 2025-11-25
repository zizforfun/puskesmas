<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../login.php");
    exit();
}

include '../koneksi/koneksi.php';
include 'partials/header.php';
include 'partials/sidebar.php';

// Ambil data pasien
$query = "SELECT * FROM pasien ORDER BY id_pasien DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasien</title>
     <link href="assets/style.css" rel="stylesheet">
</head>
<body>
    
    
    <div class="container-fluid">
        <h2 class="mb-4">Data Pasien</h2>
        <a href="logic/pasien_add.php" class="btn btn-success mb-3">+ Tambah Pasien</a>
        <table class="table table-bordered table-striped">
            <thead class="table-success">
                <tr>
                    <th>No</th>
                    <th>No Pasien</th>
                    <th>Nama Lengkap</th>
                    <th>NIK</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
        <th>Umur</th>
        <th>Alamat</th>
        <th>Status</th>
        <th>No HP</th>
        <th>Aksi</th>
    </tr>
</thead>
    <tbody>
        <?php $no=1; while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['no_pasien']; ?></td>
                <td><?= $row['nama_lengkap']; ?></td>
                <td><?= $row['NIK']; ?></td>
                <td><?= $row['tanggal_lahir']; ?></td>
                <td><?= $row['Jenis_Kelamin']; ?></td>
                <td><?= $row['umur']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td><?= $row['status_pernikahan']; ?></td>
                <td><?= $row['no_hp']; ?></td>
                <td>
                    <a href="logic/pasien_edit.php?id=<?= $row['id_pasien']; ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="logic/pasien_delete.php?id=<?= $row['id_pasien']; ?>" 
                    onclick="return confirm('Yakin hapus pasien ini?')" 
                    class="btn btn-danger btn-sm">Hapus</a>
                </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
</table>
</div>

</body>
</html>
<?php include 'partials/footer.php'; ?>