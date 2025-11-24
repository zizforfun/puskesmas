<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Kita Bersama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>
<body>
    <?php include 'component/navbar.php'; ?>
    <div class="container mt-5 pt-5">
      <h1 class="text-center text-success">Selamat Datang di Klinik Sehat Bersama</h1>
      <p class="text-center mt-3">Silakan pilih menu di bawah untuk ambil antrian atau cek antrian pasien.</p>
      <div class="text-center mt-4">
        <a href="ambilantrian.php" class="btn btn-success">Ambil Antrian</a>
        <a href="antrian.php" class="btn btn-primary">Cek Antrian</a>
      </div>
    </div>
    <?php include 'component/footer.php'; ?>
    
</body>
</html>