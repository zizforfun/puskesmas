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
  <title>Login Admin | Klinik Sehat Bersama</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
<div class="login-container">
    <div class="login-box">

        <h2 class="text-success fw-bold text-center mb-2">Login</h2>
        <p class="text-center text-muted mb-4">Masuk untuk mengakses dashboard</p>

        <form method="POST">

            <label class="fw-semibold mb-1">Username</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                <input type="text" name="username" class="form-control" required>
            </div>

            <label class="fw-semibold mb-1">Password</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" name="login" class="btn btn-success w-100 py-2 fw-semibold">
                Login
            </button>

            <p class="mt-3 text-center">
                Belum punya akun? <a href="register.php" class="text-success fw-bold">Daftar</a>
            </p>
        </form>

    </div>
</div>

<style>
    body {background: #e8f5e9; font-family: "Poppins", sans-serif;}
    .login-container { height: 100vh; display: flex; justify-content: center;
        align-items: center; padding: 20px;}
    .login-box { width: 420px; background: #ffffff; padding: 35px 32px;
        border-radius: 14px; box-shadow: 0px 6px 20px rgba(0,0,0,0.08);}
    .input-group-text { background: #f3f7f4; border-color: #c9e8d2; color: #198754;}
    .form-control { border-color: #c9e8d2;}
    .form-control:focus { border-color: #198754; box-shadow: 0 0 0 3px rgba(25,135,84,0.2);}
    button { border-radius: 10px; }
</style>
</body>
</html>
