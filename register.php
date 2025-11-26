<?php
require_once './koneksi/koneksi.php';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Username sudah digunakan');</script>";
    } else {
        $query = mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
        
        if ($query) {
            echo "<script>alert('Registrasi berhasil! Silakan login'); window.location='login.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Admin | Klinik Sehat Bersama</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">

  <style>
    .auth-wrapper { min-height: 100vh; display: flex; justify-content: center;
      align-items: center; background: linear-gradient(135deg, #f0f4f8, #d6f5e3); padding: 20px;}
    .auth-card { background: #fff; padding: 40px; border-radius: 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.1);
      max-width: 430px; width: 100%; animation: fadeInUp 0.8s ease; text-align: center;}
    .auth-card h2 { font-weight: 700; color: #198754; margin-bottom: 10px;}
    .auth-card p { color: #555; margin-bottom: 25px;}
  </style>
</head>

<body>

<div class="auth-wrapper">
  <div class="auth-card">
      <h2>Daftar Akun</h2>
      <p>Daftar untuk masuk</p>

      <form method="POST">
        <div class="mb-3 text-start">
          <label class="form-label fw-semibold">Username</label>
          <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3 text-start">
          <label class="form-label fw-semibold">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" name="register" class="btn btn-success w-100 py-2">Daftar</button>

        <p class="mt-3">Sudah punya akun? 
            <a href="login.php" class="text-success fw-bold">Login</a>
        </p>
      </form>
  </div>
</div>

</body>
</html>
