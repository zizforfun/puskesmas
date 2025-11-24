<?php
include "../koneksi/koneksi.php"; // file koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    
    $poli             = $_POST['poli']; // G, A, U
    $NIK              = $_POST['NIK'];
    $nama_lengkap     = $_POST['nama_lengkap'];
    $tanggal_lahir    = $_POST['tanggal_lahir'];
    $Jenis_Kelamin    = $_POST['Jenis_Kelamin'];
    $umur             = $_POST['umur'];
    $alamat           = $_POST['alamat'];
    $status_pernikahan= $_POST['status_pernikahan'];
    $no_hp            = $_POST['no_hp'];

    // --- Generate nomor pasien otomatis ---
    $query = "SELECT no_pasien FROM pasien 
              WHERE no_pasien LIKE '{$poli}%' 
              ORDER BY no_pasien DESC LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        // Ambil angka terakhir, misalnya G005 → 5
        $lastNumber = (int)substr($row['no_pasien'], 1);
        $newNumber  = $lastNumber + 1;
    } else {
        $newNumber = 1; // jika belum ada pasien di poli ini
    }

    // Format jadi 3 digit (001, 002, dst.)
    $formattedNumber = str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    $no_pasien = $poli . $formattedNumber;

    if($poli === 'U'){
        $namapoli = "Umum";
    }else if($poli === 'A'){
        $namapoli = "Anak";
    }else if($poli === 'G'){
        $namapoli = "Gigi";
    }
    // --- Simpan ke database ---
    $sql = "INSERT INTO pasien 
            (no_pasien, NIK, nama_lengkap, tanggal_lahir, Jenis_Kelamin, poli, umur, alamat, status_pernikahan, no_hp) 
            VALUES 
            ('$no_pasien', '$NIK', '$nama_lengkap', '$tanggal_lahir',  '$Jenis_Kelamin', '$namapoli', '$umur', '$alamat', '$status_pernikahan', '$no_hp')";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: ../ambilantrian.php?msg=Antrian berhasil diambil. Nomor pasien: $no_pasien");
        exit;
    } else {
        header("Location: ../ambilantrian.php?msg=Terjadi kesalahan: " . mysqli_error($conn));
        exit;
    }
}
?>