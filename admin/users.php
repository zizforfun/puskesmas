<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../login.php");
    exit();
}

include '../koneksi/koneksi.php';
include 'partials/header.php';
include 'partials/sidebar.php';

// Ambil data user
$query = "SELECT * FROM users ORDER BY id_user ASC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
  <div class="container-fluid">
    <h2 class="mb-4">Manajemen User</h2>
    <a href="logic/user_add.php" class="btn btn-success mb-3">+ Tambah User</a>
    <table class="table table-bordered table-striped">
      <thead class="table-success">
        <tr>
          <th>No</th>
          <th>Username</th>
          <th>Role</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; while($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['username']; ?></td>
            <td><?= $row['role']; ?></td>
            <td>
              <a href="logic/user_update.php?id=<?= $row['id_user']; ?>" class="btn btn-primary btn-sm">Edit</a>
              <a href="logic/user_edit.php?id=<?= $row['id_user']; ?>" 
              onclick="return confirm('Yakin hapus user ini?')" 
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