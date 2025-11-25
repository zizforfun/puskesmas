<?php
include "../koneksi/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $poliKode = $_POST['poli'];

    if ($poliKode == "A") $poli = "Anak";
    else if ($poliKode == "G") $poli = "Gigi";
    else if ($poliKode == "U") $poli = "Umum";
    else $poli = "Tidak diketahui";

    $NIK              = $_POST['NIK'];
    $nama_lengkap     = $_POST['nama_lengkap'];
    $tanggal_lahir    = $_POST['tanggal_lahir'];
    $Jenis_Kelamin    = $_POST['Jenis_Kelamin'];
    $umur             = $_POST['umur'];
    $alamat           = $_POST['alamat'];
    $status_pernikahan= $_POST['status_pernikahan'];
    $no_hp            = $_POST['no_hp'];

    $query = "SELECT no_pasien FROM pasien 
              WHERE no_pasien LIKE '{$poliKode}%' 
              ORDER BY no_pasien DESC LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $lastNumber = (int)substr($row['no_pasien'], 1);
        $newNumber  = $lastNumber + 1;
    } else {
        $newNumber = 1;
    }

    $formattedNumber = str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    $no_pasien = $poliKode . $formattedNumber;

    $sql = "INSERT INTO pasien 
            (no_pasien, NIK, nama_lengkap, tanggal_lahir, poli, Jenis_Kelamin, umur, alamat, status_pernikahan, no_hp) 
            VALUES 
            ('$no_pasien', '$NIK', '$nama_lengkap', '$tanggal_lahir', '$poli', '$Jenis_Kelamin', '$umur', '$alamat', '$status_pernikahan', '$no_hp')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../ambilantrian.php?msg=Antrian berhasil diambil. Nomor pasien: $no_pasien");
        exit;
    } else {
        header("Location: ../ambilantrian.php?msg=Terjadi kesalahan: " . mysqli_error($conn));
        exit;
    }
}
?>
