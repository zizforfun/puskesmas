<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../login.php");
    exit();
}
include '../../koneksi/koneksi.php';
include '../partials/header.php';


$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id'"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $role = $_POST['role'];

    // Update tanpa ganti password
    mysqli_query($conn, "UPDATE users SET username='$username', role='$role' WHERE id_user='$id'");

    // Kalau admin isi password baru
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        mysqli_query($conn, "UPDATE users SET password='$password' WHERE id_user='$id'");
    }

    header("Location: users.php");
    exit();
}
?>

<div class="container-fluid">
  <h2 class="mb-4">Edit User</h2>
  <form method="POST">
    <div class="mb-3">
      <label>Username</label>
      <input type="text" name="username" class="form-control" value="<?= $data['username']; ?>" required>
    </div>
    <div class="mb-3">
      <label>Password (kosongkan jika tidak diganti)</label>
      <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
      <label>Role</label>
      <select name="role" class="form-control">
        <option value="admin" <?= $data['role']=='admin'?'selected':''; ?>>Admin</option>
        <option value="petugas" <?= $data['role']=='petugas'?'selected':''; ?>>Petugas</option>
        <option value="dokter" <?= $data['role']=='dokter'?'selected':''; ?>>Dokter</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="../users.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

<?php include '../partials/footer.php'; ?>