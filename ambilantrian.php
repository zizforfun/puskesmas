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
</head>
<body class="bg-light">

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
                        <label class="form-label">Nama Pasien</label>
                        <input type="text" name="nama_pasien" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Umur</label>
                        <input type="number" name="umur" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" required></textarea>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Pilih Poli</label>
                        <select name="poli" class="form-control" required>
                            <option value="">-- Pilih Poli --</option>
                            <option value="Poli Umum">Poli Umum</option>
                            <option value="Poli Gigi">Poli Gigi</option>
                            <option value="Poli Anak">Poli Anak</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Ambil Antrian</button>

                </form>

            </div>
        </div>
    </div>

</div>

</body>
</html>
