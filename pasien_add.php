<?php 
include 'koneksi/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrasi Pasien Baru</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

</head>
<body>

<?php include 'component/navbar.php'; ?>

<div class="container py-5">
    <h2 class="fw-bold mb-4 text-success text-center mt-5">Registrasi Pasien Baru</h2>
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <form action="logic/proses_ambil.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">NIK</label>
                    <input type="text" name="NIK" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required>
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
                    <input type="number" name="umur" class="form-control" required>
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
                    <label class="form-label">No HP</label>
                    <input type="text" name="no_hp" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Poli</label>
                    <select name="poli" class="form-control" required>
                        <option value="">-- Pilih Poli --</option>
                        <option value="ANAK">Anak</option>
                        <option value="GIGI">Gigi</option>
                        <option value="UMUM">Umum</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success btn-lg px-4">
                    Simpan Data
                </button>

            </form>

        </div>
    </div>
</div>

<?php include 'component/footer.php'; ?>

</body>
</html>
