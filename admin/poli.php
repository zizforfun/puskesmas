<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../login.php");
    exit();
}

include '../koneksi/koneksi.php';
include 'partials/header.php';
include 'partials/sidebar.php';

// Ambil data poli
$query = "SELECT * FROM jenis_poli ORDER BY id_poli ASC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poli</title>
     <link href="assets/style.css" rel="stylesheet">
</head>
<body>
    
    <div class="container-fluid">
        <h2 class="mb-4">Data Poli</h2>
        <a href="logic/poli_add.php" class="btn btn-success mb-3">+ Tambah Poli</a>
        <table class="table table-bordered table-striped">
            <thead class="table-success">
                <tr>
                    <th>No</th>
        <th>Nama Poli</th>
        <th>Kode Poli</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    <?php $no=1; while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama_poli']; ?></td>
            <td><?= $row['kode_poli']; ?></td>
            <td>
                <a href="logic/poli_edit.php?id=<?= $row['id_poli']; ?>" class="btn btn-primary btn-sm">Edit</a>
                <a href="logic/poli_delete.php?id=<?= $row['id_poli']; ?>" 
                onclick="return confirm('Yakin hapus poli ini?')" 
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