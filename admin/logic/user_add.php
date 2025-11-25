<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../login.php");
    exit();
}
include '../../koneksi/koneksi.php';
include '../partials/header.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    mysqli_query($conn, "INSERT INTO users(username,password,role) VALUES('$username','$password','$role')");
    header("Location: users.php");
    exit();
}
?>

<div class="container-fluid">
  <h2 class="mb-4">Tambah User</h2>
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
    <a href="users.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?php include '../partials/footer.php'; ?>