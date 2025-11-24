<?php
// Ambil pesan jika redirect dari proses_ambil.php
$msg = isset($_GET['msg']) ? $_GET['msg'] : "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ambil Antrian</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color: #e9f5ef;">

<div class="container mt-5">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow">
            <div class="card-body">

                <h3 class="text-center fw-bold text-success mb-4">Ambil Antrian</h3>

                <?php if ($msg != ""): ?>
                    <div class="alert alert-info text-center"><?= htmlspecialchars($msg) ?></div>
                <?php endif; ?>

                <!-- Tab Navigation -->
                <ul class="nav nav-tabs" id="poliTab" role="tablist" d-flex justify-content-center align-items-center>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="gigi-tab" data-bs-toggle="tab" data-bs-target="#gigi" type="button" role="tab">Poli Gigi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="anak-tab" data-bs-toggle="tab" data-bs-target="#anak" type="button" role="tab">Poli Anak</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="umum-tab" data-bs-toggle="tab" data-bs-target="#umum" type="button" role="tab">Poli Umum</button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="poliTabContent">

                    <!-- Poli Gigi -->
                    <div class="tab-pane fade show active" id="gigi" role="tabpanel">
                        <form action="logic/proses_ambil.php" method="POST">
                            <input type="hidden" name="poli" value="G">
                            <?php include 'form_pasien.php'; ?>
                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-success">Daftar Poli Gigi</button>
                            </div>
                        </form>
                    </div>

                    <!-- Poli Anak -->
                    <div class="tab-pane fade" id="anak" role="tabpanel">
                        <form action="logic/proses_ambil.php" method="POST">
                            <input type="hidden" name="poli" value="A">
                            <?php include 'form_pasien.php'; ?>
                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-primary">Daftar Poli Anak</button>
                            </div>
                        </form>
                    </div>

                    <!-- Poli Umum -->
                    <div class="tab-pane fade" id="umum" role="tabpanel">
                        <form action="logic/proses_ambil.php" method="POST">
                            <input type="hidden" name="poli" value="U">
                            <?php include 'form_pasien.php'; ?>
                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-info">Daftar Poli Umum</button>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- Tombol Kembali ke Menu Utama -->
                <div class="text-center mt-4" >
                    <a href="index.php" class="btn btn-outline-secondary">
                        ⬅ Kembali ke Menu Utama
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>