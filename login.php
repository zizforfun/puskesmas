<?php
session_start();
require_once './koneksi/koneksi.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $data  = mysqli_fetch_assoc($query);

    if ($data && password_verify($password, $data['password'])) {
        $_SESSION['id_user']  = $data['id_user'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['username'] = $data['username'];

        header("Location: admin/dashboard.php");
        exit;
    } else {
        echo "<script>alert('Username atau password salah');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin| Klinik Sehat Bersama</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">

  <style>
    .auth-wrapper {
      min-height: 100vh; display: flex; justify-content: center; align-items: center;
      background: linear-gradient(135deg, #f0f4f8, #e8f5e9); padding: 20px;}
    .auth-card { background: #fff; padding: 40px; border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.1);
      max-width: 430px; width: 100%; animation: fadeInUp 0.8s ease; text-align: center;}
    .auth-card h2 { font-weight: 700; color: #198754; margin-bottom: 10px;}
    .auth-card p { color: #555; margin-bottom: 25px;}
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); }
                          to   { opacity: 1; transform: translateY(0); }}
  </style>
</head>

<body>

<div class="auth-wrapper">
  <div class="auth-card">
      <h2>Login</h2>
      <p>Masuk untuk menggunakan layanan antrian</p>

      <form method="POST">
        <div class="mb-3 text-start">
          <label class="form-label fw-semibold">Username</label>
          <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3 text-start">
          <label class="form-label fw-semibold">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" name="login" class="btn btn-success w-100 py-2">Login</button>

        <p class="mt-3">Belum punya akun? 
            <a href="register.php" class="text-success fw-bold">Daftar</a>
        </p>
      </form>
  </div>
</div>

</body>
</html>
