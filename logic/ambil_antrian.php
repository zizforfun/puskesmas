<?php
require "../koneksi/koneksi.php";

$id_poli   = intval($_POST['id_poli']);
$id_pasien = intval($_POST['id_pasien']);
$tanggal   = date('Y-m-d');

// Mapping prefix poli (contoh, bisa ambil dari tabel jenis_poli)
$prefixMap = [1 => 'U', 2 => 'G', 3 => 'A'];
$prefix    = $prefixMap[$id_poli] ?? 'X';

mysqli_begin_transaction($conn);

try {
    // Ambil nomor terakhir untuk poli & tanggal hari ini
    $sqlMax = "SELECT MAX(no_urut) AS last_no
               FROM antrian
               WHERE id_poli = ? AND tanggal_kunjungan = CURDATE()";
    $stmt = mysqli_prepare($conn, $sqlMax);
    mysqli_stmt_bind_param($stmt, "i", $id_poli);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);
    $lastNo = $row['last_no'] ? intval($row['last_no']) : 0;

    $nextNo = $lastNo + 1;
    $kode   = $prefix . str_pad($nextNo, 3, '0', STR_PAD_LEFT);

    // Insert baris baru
    $sqlIns = "INSERT INTO antrian (id_pasien, id_poli, tanggal_kunjungan, no_urut, no_antrian, status)
               VALUES (?, ?, ?, ?, ?, 'menunggu')";
    $stmt2 = mysqli_prepare($conn, $sqlIns);
    mysqli_stmt_bind_param($stmt2, "iisis", $id_pasien, $id_poli, $tanggal, $nextNo, $kode);
    mysqli_stmt_execute($stmt2);

    mysqli_commit($conn);

    // Pop-up alert + redirect
// ... proses insert antrian

// ... setelah insert antrian
echo "
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Nomor Antrian</title>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
  <style>
    /* Animasi zoom in */
    @keyframes zoomIn {
      from { transform: scale(0.5); opacity: 0; }
      to   { transform: scale(1); opacity: 1; }
    }
    .animate-number {
      animation: zoomIn 0.6s ease-out;
    }

    /* Animasi fade in untuk modal body */
    @keyframes fadeInUp {
      from { transform: translateY(30px); opacity: 0; }
      to   { transform: translateY(0); opacity: 1; }
    }
    .animate-body {
      animation: fadeInUp 0.8s ease-out;
    }
  </style>
</head>
<body>
  <div class='modal fade show' id='antrianModal' tabindex='-1' style='display:block;' aria-modal='true' role='dialog'>
    <div class='modal-dialog modal-dialog-centered'>
      <div class='modal-content'>
        <div class='modal-header bg-success text-white'>
          <h5 class='modal-title'>Nomor Antrian Anda</h5>
        </div>
        <div class='modal-body text-center animate-body'>
          <h1 class='fw-bold text-success animate-number'>$kode</h1>
          <p class='mt-3'>Silakan menunggu panggilan sesuai urutan.</p>
        </div>
        <div class='modal-footer'>
          <a href='../index.php' class='btn btn-success'>Kembali ke Beranda</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
";

} catch (Throwable $e) {
    mysqli_rollback($conn);
    http_response_code(500);
    echo "Terjadi kesalahan saat mengambil nomor antrian.";
}