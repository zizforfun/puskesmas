<?php
// Ambil pesan jika redirect dari proses_ambil.php
$msg = isset($_GET['msg']) ? $_GET['msg'] : "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ambil Antrian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color: #e9f5ef;">

<div class="container mt-5">
    <div class="col-lg-6 mx-auto">
        <div class="card shadow">
            <div class="card-body">

                <h3 class="text-center fw-bold text-success mb-4">Ambil Antrian</h3>

                <?php if ($msg != ""): ?>
                    <div class="alert alert-info text-center"><?= htmlspecialchars($msg) ?></div>
                <?php endif; ?>

                <form action="logic/proses_ambil.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">No. Pasien</label>
                        <input type="text" name="no_pasien" class="form-control" maxlength="11" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">NIK</label>
                        <input type="text" name="NIK" class="form-control" maxlength="20" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" maxlength="255" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="Jenis_Kelamin" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Umur</label>
                        <input type="number" name="umur" class="form-control" min="0" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status Pernikahan</label>
                        <select name="status_pernikahan" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="Belum Menikah">Belum Menikah</option>
                            <option value="Menikah">Menikah</option>
                            <option value="Cerai">Cerai</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No. HP</label>
                        <input type="text" name="no_hp" class="form-control" maxlength="15" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Ambil Antrian</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

</body>
</html>
