<?php
require "../config/koneksi.php";

$nama_pasien   = $_POST['nama_pasien'];
$umur          = $_POST['umur'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$alamat        = $_POST['alamat'];
$poli          = $_POST['poli'];

$kode_poli = [
    "Poli Umum" => "U",
    "Poli Gigi" => "G",
    "Poli Anak" => "A"
];

$prefix = $kode_poli[$poli];

$sql_last = "SELECT no_antrian FROM antrian WHERE poli='$poli' ORDER BY id_antrian DESC LIMIT 1";
$q_last = mysqli_query($koneksi, $sql_last);

if (mysqli_num_rows($q_last) > 0) {
    $row = mysqli_fetch_assoc($q_last);
    $last_number = intval(substr($row['no_antrian'], 1));
    $new_number  = $last_number + 1;
} else {
    $new_number = 1;
}

$no_antrian = $prefix . str_pad($new_number, 3, '0', STR_PAD_LEFT);

// Query insert lengkap
$sql_insert = "INSERT INTO antrian 
               (no_antrian, nama_pasien, umur, tanggal_lahir, alamat, poli, waktu_daftar, status)
               VALUES 
               ('$no_antrian', '$nama_pasien', '$umur', '$tanggal_lahir', '$alamat', '$poli', NOW(), 'Menunggu')";

$query = mysqli_query($koneksi, $sql_insert);

if ($query) {
    header("Location: ../ambilantrian.php?msg=Berhasil! Nomor Antrian Anda: $no_antrian");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
