<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../login.php");
    exit();
}

include '../../koneksi/koneksi.php';

// Periksa apakah ID ada
if (!isset($_GET['id'])) {
    header("Location: ../antrian.php");
    exit();
}

$id = $_GET['id'];

// Ambil data antrian sebelum dihapus
$query = "
    SELECT *
    FROM antrian
    WHERE id_antrian = '$id'
";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>alert('Data antrian tidak ditemukan'); window.location='../antrian.php';</script>";
    exit();
}
if ($data['status'] === 'menunggu'){
    $status = 'batal';
}else{
    $status = 'selesai';
}

// Pindahkan data ke tabel riwayat
mysqli_query($conn, "
    INSERT INTO riwayat_antrian 
    (id_antrian, id_pasien, id_poli, no_urut, no_antrian, tanggal_kunjungan, status)
    VALUES (
        '{$data['id_antrian']}',
        '{$data['id_pasien']}',
        '{$data['id_poli']}',
        '{$data['no_urut']}',
        '{$data['no_antrian']}',
        '{$data['tanggal_kunjungan']}',
        '$status'
    )
");

// Hapus dari tabel antrian
mysqli_query($conn, "DELETE FROM antrian WHERE id_antrian = '$id'");

echo "<script>
        alert('Antrian berhasil dihapus dan dipindahkan ke Riwayat Antrian');
        window.location='../antrian.php';
      </script>";
?>
