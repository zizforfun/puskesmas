<?php require_once './logic/auth.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambil Antrian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php include 'component/navbar.php'; ?>
<div class="container mt-5 pt-5">
  <h3 class="text-center fw-bold text-success mb-4">Ambil Antrian</h3>

  <ul class="nav nav-tabs" id="poliTab" role="tablist">
    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#anak">Poli Anak</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#gigi">Poli Gigi</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#umum">Poli Umum</button></li>
  </ul>

  <div class="tab-content mt-3">
    <!-- Poli Anak -->
    <div class="tab-pane fade show active" id="anak">
      <form action="logic/proses_ambil.php" method="POST">
        <input type="hidden" name="poli" value="A">
        <?php include 'form_pasien.php'; ?>
        <div class="d-grid mt-3">
          <button type="submit" class="btn btn-success">Daftar Poli Anak</button>
        </div>
      </form>
    </div>

    <!-- Poli Gigi -->
    <div class="tab-pane fade" id="gigi">
      <form action="logic/proses_ambil.php" method="POST">
        <input type="hidden" name="poli" value="G">
        <?php include 'form_pasien.php'; ?>
        <div class="d-grid mt-3">
          <button type="submit" class="btn btn-danger">Daftar Poli Gigi</button>
        </div>
      </form>
    </div>

    <!-- Poli Umum -->
    <div class="tab-pane fade" id="umum">
      <form action="logic/proses_ambil.php" method="POST">
        <input type="hidden" name="poli" value="U">
        <?php include 'form_pasien.php'; ?>
        <div class="d-grid mt-3">
          <button type="submit" class="btn btn-info">Daftar Poli Umum</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'component/footer.php'; ?>
</body>
</html>
