<?php
include "../koneksi/koneksi.php";

// Ambil data pasien dari POST
$NIK                = $_POST['NIK'];
$nama_lengkap       = $_POST['nama_lengkap'];
$tanggal_lahir      = $_POST['tanggal_lahir'];
$Jenis_Kelamin      = $_POST['Jenis_Kelamin'];
$umur               = $_POST['umur'];
$alamat             = $_POST['alamat'];
$status_pernikahan  = $_POST['status_pernikahan'];
$no_hp              = $_POST['no_hp'];
$poli               = $_POST['poli'];

// ====================
// INSERT DATA PASIEN
// ====================

$sql_pasien = "INSERT INTO pasien 
               (NIK, nama_lengkap, tanggal_lahir, Jenis_Kelamin, umur, alamat, status_pernikahan, no_hp) 
               VALUES 
               ('$NIK', '$nama_lengkap', '$tanggal_lahir', '$Jenis_Kelamin', '$umur', '$alamat', '$status_pernikahan', '$no_hp')";

mysqli_query($koneksi, $sql_pasien);

// ====================
// GENERATE NOMOR ANTRIAN
// ====================

$kode_poli = [
    "Poli Umum" => "U",
    "Poli Gigi" => "G",
    "Poli Anak" => "A"
];

$prefix = $kode_poli[$poli];

// Ambil nomor antrian terakhir
$sql_last = "SELECT id_pasien FROM pasien WHERE poli='$poli' ORDER BY id_pasien DESC LIMIT 1";
$q_last = mysqli_query($koneksi, $sql_last);

if (mysqli_num_rows($q_last) > 0) {
    $row = mysqli_fetch_assoc($q_last);
    $last_number = intval(substr($row['no_antrian'], 1));
    $new_number  = $last_number + 1;
} else {
    $new_number = 1;
}

$no_antrian = $prefix . str_pad($new_number, 3, '0', STR_PAD_LEFT);

// ====================
// INSERT KE TABEL ANTRIAN
// ====================
$sql_insert = "INSERT INTO pasien 
               (no_antrian, nama_pasien, poli, waktu_daftar, status)
               VALUES 
               ('$no_antrian', '$nama_lengkap', '$poli', NOW(), 'Menunggu')";

$query = mysqli_query($koneksi, $sql_insert);

// ====================
// REDIRECT
// ====================
if ($query) {
    header("Location: ../index.php?msg=Berhasil! Nomor Antrian Anda: $no_antrian");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
