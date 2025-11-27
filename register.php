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
  <title>Register | Klinik Sehat Bersama</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<div class="register-container">
    <div class="register-box">

        <h2 class="text-success fw-bold text-center mb-2">Daftar Akun</h2>
        <p class="text-center text-muted mb-4">Silahkan buat akun baru</p>

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

            <button type="submit" name="register" class="btn btn-success w-100 py-2 fw-semibold">
                Daftar
            </button>

            <p class="mt-3 text-center">
                Sudah punya akun? <a href="login.php" class="text-success fw-bold">Login</a>
            </p>
        </form>

    </div>
</div>

<style>
    body { background: #e8f5e9; font-family: "Poppins", sans-serif;}

    .register-container { height: 100vh; display: flex; justify-content: center;
        align-items: center; padding: 20px;}
    .register-box { width: 420px; background: #ffffff; padding: 35px 32px; border-radius: 14px;
        box-shadow: 0px 6px 20px rgba(0,0,0,0.08);}
    .input-group-text { background: #f3f7f4; border-color: #c9e8d2; color: #198754;}
    .form-control { border-color: #c9e8d2;}
    .form-control:focus { border-color: #198754; box-shadow: 0 0 0 3px rgba(25,135,84,0.2);}
    button { border-radius: 10px;}
</style>
</body>
</html>
