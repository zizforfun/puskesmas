<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../login.php");
    exit();
}
include '../../koneksi/koneksi.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    mysqli_query($conn, "INSERT INTO users(username,password,role) VALUES('$username','$password','$role')");
    header("Location: users.php");
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
      <h2 class="mb-4" style="text-align :center">Tambah User</h2>
      <form method="POST">
        <div class="mb-3">
          <label>Username</label>
          <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Role</label>
          <select name="role" class="form-control">
            <option value="admin">Admin</option>
            <option value="petugas">Petugas</option>
            <option value="dokter">Dokter</option>
          </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="../users.php" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
  </body>
  </html>
  
  <?php include '../partials/footer.php'; ?>