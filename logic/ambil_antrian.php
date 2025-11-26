<?php
require "../koneksi/koneksi.php";

$id_poli   = intval($_POST['id_poli']);
$id_pasien = intval($_POST['id_pasien']);
$tanggal   = date('Y-m-d');

// Mapping prefix poli (contoh)
$prefixMap = [1 => 'U', 2 => 'G', 3 => 'A'];
$prefix    = $prefixMap[$id_poli] ?? 'X';

mysqli_begin_transaction($conn);

try {
    // Ambil nomor terakhir per poli per hari
    $sqlMax = "SELECT MAX(no_urut) AS last_no
               FROM antrian
               WHERE id_poli = ? AND tanggal_kunjungan = ?";
    $stmt = mysqli_prepare($conn, $sqlMax);
    mysqli_stmt_bind_param($stmt, "is", $id_poli, $tanggal);
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

    // Pop-up JS sederhana + redirect
    echo "<script>
            alert('Nomor antrian Anda: $kode');
            window.location.href = '../index.php';
          </script>";
} catch (Throwable $e) {
    mysqli_rollback($conn);
    http_response_code(500);
    echo "Terjadi kesalahan saat mengambil nomor antrian.";
}