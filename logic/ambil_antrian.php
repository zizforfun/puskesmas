<?php
include '../koneksi/koneksi.php';

$id_pasien = $_POST['id_pasien'];
$id_poli   = $_POST['id_poli'];
$tanggal   = date('Y-m-d');

// cari nomor antrian terakhir untuk poli ini di hari ini
$q = mysqli_query($conn, "SELECT MAX(no_antrian) AS max FROM antrian WHERE id_poli='$id_poli' AND tanggal_kunjungan='$tanggal'");
$data = mysqli_fetch_assoc($q);
$next_no = $data['max'] ? $data['max'] + 1 : 1;

// simpan antrian baru
mysqli_query($conn, "INSERT INTO antrian (id_pasien,id_poli,tanggal_kunjungan,no_antrian,status) 
                     VALUES ('$id_pasien','$id_poli','$tanggal','$next_no','menunggu')");

header("Location: ../antrian.php");
exit();